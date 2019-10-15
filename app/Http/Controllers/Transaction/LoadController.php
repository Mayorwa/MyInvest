<?php

namespace App\Http\Controllers\Transaction;

use App\Models\Agency;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\trxntokens;
use App\Http\Helpers\Helper;
use App\Http\Helpers\Validate;
use App\Models\Property;
use App\Models\landTrnx;
use App\Models\InsPayment;
use App\Http\Helpers\apiHelper;
use App\Models\Subscription;
use App\Http\Helpers\sendMail;
use App\Models\Estate;
use App\Models\User;
use Paystack;
use App\Models\Customer;

class LoadController extends Controller
{
    //
    private $transaction;
    private $trxntokens;
    private $paystack;
    private $helper;
    private $property;
    private $validate;
    private $landtrnx;
    private $ins;
    private $api;
    private $mail;
    private $subscription;
    private $estate;
    private $customer;
    private $user;
    private $agency;
    public function __construct(Transaction $transaction, trxntokens $trxntokens, Helper $helper, Validate $validate, Paystack $paystack, Property $property, landTrnx $landtrnx, InsPayment $ins, apiHelper $api,Subscription $subscription, sendMail $mail,Estate $estate, Customer $customer, User $user, Agency $agency) {
        $this->transaction = $transaction;
        $this->paystack = $paystack;
        $this->trxntokens = $trxntokens;
        $this->validate = $validate;
        $this->helper = $helper;
        $this->property = $property;
        $this->landtrnx = $landtrnx;
        $this->ins = $ins;
        $this->api = $api;
        $this->subscription = $subscription;
        $this->mail = $mail;
        $this->estate = $estate;
        $this->customer = $customer;
        $this->user = $user;
        $this->agency = $agency;
    }

    public function startTrxn(Request $request){
        try {
            //get the request body
            $body = $request->except('_token');

            //validate the request body
            $validation = $this->validate->trnx($body, "register");

            if($validation->fails())
            {
                //format the error messages
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());
                return response()->json(['message' => $errorMessages, 'data' => $body, 'error' => true], 403);
            } else {
                //get the token
                $token = $this->helper->generateToken();

                $params = [
                    "token" =>  $token,
                    "reference"  => Paystack::genTranxRef(),
                    "itemId" => $body["itemId"],
                    "amount" => $body["amount"] * $body["quantity"],
                    "userId" => $body["userId"],
                    "quantity" => $body["quantity"],
                ];

                if($body["refered"] == 1){
                    $getAgency = $this->agency->where("uniqueId", $body["refered"])->first();
                    if($getAgency != null){
                        $params["referredId"] = $body["referrerId"];
                    } else{
                        return response()->json(['message' => 'Agent Not found', 'data' => [], 'error' => false], 500);
                    }
                }
                //store the token
                $params['id'] = $this->trxntokens->create($params)->id;

                return response()->json(['message' => 'Transaction token successfully created', 'data' => $params, 'error' => false], 200);
            }
        } catch(\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'data' => [], 'error' => true], 500);
        }
    }

    public function makePayment(Request $request){
        try {
            return $this->paystack::getAuthorizationUrl()->redirectNow();

        } catch (\Exception $e) {
            \Session::put('red', 1);

            return redirect()->back()->withErrors("We encountered a problem: ".$e->getMessage());
        }
    }

    public function confirmPayment(Request $request){
        try {
            $paymentDetails = Paystack::getPaymentData();
            $request->request->remove('reference', 'trxref');
            $ref = $paymentDetails["data"]["reference"];
            $customer_code = $paymentDetails["data"]["customer"]["customer_code"];
            $customer_id = $paymentDetails["data"]["customer"]["id"];
            $auth_code = $paymentDetails["data"]["authorization"]["authorization_code"];

            $getToken = $this->trxntokens->where("reference", $ref)->first();

            $cusParams = [
                "userId" => $getToken->userId,
                "customer_code" => $customer_code,
                "paystackId" => $customer_id,
            ];
            $this->customer->create($cusParams);

            $params = [
                "userId" => $getToken->userId,
                "itemId" => $getToken->itemId,
                "amount" => $getToken->amount,
                "message" => "Successful",
                "referredId" => $getToken->referredId,
                "token" => $getToken->token,
                "reference" => $ref,
                "slug" => str_random(10),
            ];

            $getEstate = $this->estate->where(["isActive" => true, "id" => $getToken->itemId]);
            $cEstate = $getEstate->first();

            $usersDetails = $this->user->where('id', $getToken->userId)->first();
            $dta = [
                "name" => $usersDetails->name,
                "email" => $usersDetails->email,
                "slug" => $usersDetails->slug,
                "property" => $cEstate,
                "estate" => $cEstate,
            ];

            $this->mail->Reciept($dta);

            if($getEstate->first() !== null){
                $transactionId = $this->transaction->create($params)->id;
                $newQuantityn = $cEstate->noOfPlots  - $getToken->quantity;
                $newSold = $cEstate->noOfSoldPlots +  $getToken->quantity;
                $getEstate->update(["noOfPlots" => $newQuantityn, "noOfSoldPlots" => $newSold]);
            } else {
                \Session::put('red', 1);

                return redirect('/')->withErrors("We encountered a problem: ");
            }

            $getIns = $this->ins->where(["price" => $getToken->amount / $getToken->quantity , "estateId" => $getToken->itemId])->first();
//            dd($getIns);
            if($getIns !== null){
                $cycle = $getIns->noOfMonths;
                $isCompleted = false;
            } else {
                $div = $cEstate->amount / $getToken->amount;
                if($div == 1) {
                    $cycle = $div;
                    $isCompleted = true;
                } else {
                    \Session::put('red', 1);

                    return redirect('/listings')->withErrors("We encountered a problem: ");
                }
            }
            $day = date("Y-m-d");

            $p = date("Y-m-d",strtotime("+1 month", strtotime($day)));
            $getLandTrnx = $this->landtrnx->where(["itemId" => $getToken->itemId, "userId" => $getToken->userId]);
            if($getLandTrnx->first() == null){
                $landParams = [
                    "itemId" => $getToken->itemId,
                    "userId" => $getToken->userId,
                    "cycle" => $cycle,
                    "cycleCompleted" => 1,
                    "isCompleted" => $isCompleted,
                    "slug" => str_random(10),
                ];
                if(!$isCompleted){
                    $landParams["nextPayment"] = $p;
                }

                $this->landtrnx->create($landParams);
            }else{
                $rawTrnx = $getLandTrnx->first();

                $landParams = [
                    "cycleCompleted" => $rawTrnx->cycleCompleted + 1,
                    "isCompleted"  => $isCompleted,
                ];
                if(!$isCompleted){
                    $landParams["nextPayment"] = $p;
                }

                $getLandTrnx->update($landParams);
            }
            $getLandTrnx = $this->landtrnx->where(["itemId" => $getToken->itemId, "userId" => $getToken->userId])->first();
            $getSub = $this->subscription->where(["landId" => $getToken->itemId])->first();

            if(!$isCompleted && $getSub == null) {
                $request->merge([
                    'name' => $getLandTrnx->slug,
                    'interval' => 'monthly',
                    'amount' => $getToken->amount,
                ]);
                $planRes = Paystack::createPlan();

                $plan_code = $planRes["data"]["plan_code"];

                $request->request->remove('name', 'interval', 'amount');
                $request->merge([
                    'customer' => $customer_code,
                    'plan' => $plan_code,
                    'authorization' => $auth_code,
                ]);
                $subParams = Paystack::createSubscription();
//                dd($subParams);
                $sub_code = $subParams["data"]["subscription_code"];
                $email_token = $subParams["data"]["email_token"];

                $params_sub = [
                    "landId" => $getToken->itemId,
                    "userId" => $getToken->userId,
                    "sub_code" => $sub_code,
                    "email_token" => $email_token,
                ];
                $this->subscription->create($params_sub);

            }
            if($isCompleted && $getSub != null){
                $request->merge([
                    'code' => $getSub->sub_code,
                    'token' => $getSub->email_token,
                ]);
                Paystack::disableSubscription();
            }

//            $this->api->processPayment($paymentDetails);
            \Session::put('green', 1);

            return redirect('/listings')->withErrors("Transaction Successful");
        } catch (\Exception $e) {
            \Session::put('red', 1);

            return redirect('/listings')->withErrors("We encountered a problem: ".$e->getMessage());
        }
    }

//    public function forTheCron(Request $request){
//        try{
//        } catch (\Exception $e){
//            \Session::put('red', 1);
//
//            return redirect('/listings')->withErrors("We encountered a problem: ".$e->getMessage());
//        }
//    }

}

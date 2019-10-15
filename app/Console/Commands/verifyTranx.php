<?php

namespace App\Console\Commands;

use App\Http\Helpers\Helper;
use App\Models\Agency;
use App\Models\Estate;
use App\Models\Transaction;
use Illuminate\Console\Command;
use App\Models\landTrnx;
use App\Models\Customer;
use Paystack;
use App\Http\Helpers\apiHelper as Api;
use App\Models\Property;
use App\Models\InsPayment;
use App\Models\Subscription;
use App\Http\Helpers\sendMail;
use App\Models\User;

class verifyTranx extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'verify:tran';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verify transactions';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $transaction;
    private $paystack;
    private $helper;
    private $property;
    private $landtrnx;
    private $ins;
    private $api;
    private $mail;
    private $subscription;
    private $estate;
    private $user;
    public function __construct(Api $api, Transaction $transaction, Helper $helper, Paystack $paystack, Property $property, landTrnx $landtrnx, InsPayment $ins,Subscription $subscription, sendMail $mail,Estate $estate, User $user)
    {
        $this->transaction = $transaction;
        $this->paystack = $paystack;
        $this->helper = $helper;
        $this->property = $property;
        $this->landtrnx = $landtrnx;
        $this->ins = $ins;
        $this->api = $api;
        $this->subscription = $subscription;
        $this->mail = $mail;
        $this->estate = $estate;
        $this->user = $user;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $day = date("Y-m-d");

            $getlandTrns = landTrnx::where(["nextPayment" => $day, "isCompleted" => false])->get();

            foreach ($getlandTrns as $trnx) {
                $getCustomer = Customer::where("userId", $trnx->userId)->first();

                $getTrnxPaystack = $this->api->call('/transaction?customer='.$getCustomer->paystackId.'&status=success&from=' . $day, 'GET');

                $trnxRes = $getTrnxPaystack->data;
                foreach ($trnxRes as $trnxRe) {

                    $trnxRe->fullamt = $trnxRe->amount / 100;
                    $params = [
                        "userId" => $trnx->userId,
                        "itemId" => $trnx->landId,
                        "amount" => $trnxRe->fullamt,
                        "message" => "Successful",
                        "token" => $trnxRe->reference,
                        "reference" => $trnxRe->reference,
                        "slug" => str_random(10),
                    ];

                    $getEstate = $this->estate->where(["isActive" => true, "id" => $trnx->itemId]);
                    $cEstate = $getEstate->first();

                    $users = $this->user->where("id", $trnx->userId)->first();

                    $dta = [
                        "name" => $users->name,
                        "email" => $users->email,
                        "slug" => $users->slug,
                        "property" => $cEstate,
                        "estate" => $cEstate,
                    ];

                    $this->mail->Reciept($dta);

                    if ($getEstate->first() !== null) {
                        $transactionId = $this->transaction->create($params)->id;
                    } else {
                        \Session::put('red', 1);

                        return redirect('/')->withErrors("We encountered a problem: ");
                    }

                    $getIns = $this->ins->where(["price" => $trnxRe->amount, "estateId" => $trnx->itemId])->first();
                    $day = date("Y-m-d");
                    $p = date("Y-m-d", strtotime("+1 month", strtotime($day)));
                    $getLandTrnx = $this->landtrnx->where(["id" => $trnx->id, "userId" => $trnx->userId]);
                    if ($getLandTrnx->first() !== null) {
                        $rawTrnx = $getLandTrnx->first();

                        if ($getIns !== null) {
                            if ($rawTrnx->cycleCompleted + 1 >= $getIns->noOfMonths) {
//                                $isCompleted = false;
                                $isCompleted = true;
                            } else {
                                $isCompleted = false;
                            }
                        }

                        $landParams = [
                            "cycleCompleted" => $rawTrnx->cycleCompleted + 1,
                            "isCompleted" => $isCompleted,
                        ];
                        if (!$isCompleted) {
                            $landParams["nextPayment"] = $p;
                        }

                        $getLandTrnx->update($landParams);
                    }
                }


                $getSub = $this->subscription->where(["landId" => $trnx->itemId])->first();
                if ($isCompleted && $getSub != null) {
                    $disableParams = [
                        'code' => $getSub->sub_code,
                        'token' => $getSub->email_token,
                    ];
                    $this->api->call('/subscription/disable', 'POST', $disableParams);
                }
            }
            //
        }catch(\Exception $e){
            return $e->getMessage();
        }
    }
}

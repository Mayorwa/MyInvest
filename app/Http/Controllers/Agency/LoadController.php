<?php

namespace App\Http\Controllers\Agency;

use App\Models\agentRelation;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Helper;
use App\Http\Helpers\sendMail;
use App\Http\Helpers\Validate;
use App\Models\Agency;
use Auth;
use App\Models\Code;

class LoadController extends Controller
{
    //
    private $auth;
    private $user;
    private $helper;
    private $validate;
    private $codes;
    private $mail;
    private $agency;
    private $agentRelation;
    public function __construct(Auth $auth, User $user, Helper $helper, Validate $validate, sendMail $mail, Agency $agency, Code $codes, agentRelation $agentRelation) {
        $this->auth = $auth;
        $this->user = $user;
        $this->helper = $helper;
        $this->validate = $validate;
        $this->mail = $mail;
        $this->agency = $agency;
        $this->codes = $codes;
        $this->agentRelation = $agentRelation;
    }

    public function signUp(Request $request){
        try {
            $body = $request->except('_token');

            $validation = $this->validate->agency($body, "create");

            if($validation->fails())
            {
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                \Session::put("red", true);
                return redirect()->back()->withErrors($errorMessages);
            }else {

                $body["slug"] = str_random(10);

                // make user account in active till email is verified
                $body['isActive'] = 0;

                if($body["radios"] == 1){
                    $body['type'] = "consultant";
                } else{
                    $body['type'] = "realtor";
                }

                if($body["uniqueOpt"] == 2) {
                    $relations = $this->agentRelation->where('isDefault', true)->first();
                    $body["refUniqueId"] = $relations->userId;
                } else{
                    $getRelate = $this->agency->where("uniqueId", $body["refUniqueId"] )->first();
                    if($getRelate == null){
                        \Session::put("red", true);
                        return redirect()->back()->withErrors("Invalid agent Id");
                    }
                    else{
                        $body["refUniqueId"] = $getRelate->userId;
                    }
                }

                //encrypt password string
                $body["password"] = bcrypt($body["password"]);


                $body['id'] = $this->user->create($body)->id;

                //remove passwords from request body
                unset($body["password"]);
                unset($body["password_confirmation"]);

                $snd = [
                    "email" => $body["email"],
                ];

                $this->getSignUpCode($snd);


                $params = [
                    "companyId" => $body["companyId"],
                    "uniqueId" => str_random(15),
                    "slug" => str_random(10),
                    "userId" => $body["id"],
                ];

                $this->agency->create($params);


                $relationParams = [
                    "userId" => $body["id"],
                    "uplineId" => $body["refUniqueId"],
                ];

                $this->agentRelation->create($relationParams);

                \Session::put("green", true);
//                \Session::forget('email');
                return redirect('/auth/login')->withErrors("Account created successfully, Please check your email for verification");
            }
        } catch(\Exception $e){
            \Session::put("red", true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
    public function getSignUpCode($body)
    {
        //generate a six digit code and add to request body

        $body["code"] = mt_rand(350000, 999999);

        //send code to the user
        $this->mail->sendSignUpCode($body);

        //save the details
        $this->codes->create($body);
    }

    public function editInfo(Request $request){
        try{
            $body = $request->except("_token");

            $validation = $this->validate->agency($body, "update");
            if($validation->fails()){
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                \Session::put("red", true);
                return redirect()->back()->withErrors($errorMessages);
            } else {

                $user = $this->user->where('slug', $body["slug"]);
                if($user->first() === null){
                    \Session::put('red', true);
                    return redirect()->back()->withErrors("An Error Occured");
                } else{
                    $user->update([
                        'address' => $body["address"],
                        'name' => $body['name'],
                        'dob' => $body['dob'],
                        'phone' => $body['phone'],
                    ]);
                    $agency = $this->agency->where('slug', $body['agencySlug']);
                    if($agency->first() === null){
                        \Session::put('red', true);
                        return redirect()->back()->withErrors("An Error Occured");
                    } else {
                        $agency->update([
                            'accountNumber' => $body["accountNumber"]
                        ]);
                    }
                    \Session::put('green', true);
                    return redirect()->back()->withErrors("Account Updated Successfully");
                }
            }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

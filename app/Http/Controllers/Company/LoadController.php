<?php

namespace App\Http\Controllers\Company;

use App\Http\Helpers\Helper;
use App\Http\Helpers\sendMail;
use App\Http\Helpers\Validate;
use App\Models\Code;
use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class LoadController extends Controller
{
    //
    private $auth;
    private $user;
    private $helper;
    private $codes;
    private $validate;
    private $mail;
    private $company;

    public function __construct(Auth $auth, User $user, Helper $helper, Validate $validate, Code $codes, sendMail $mail, Company $company) {
        $this->auth = $auth;
        $this->user = $user;
        $this->helper = $helper;
        $this->codes = $codes;
        $this->validate = $validate;
        $this->mail = $mail;
        $this->company = $company;
    }

    public function signUp(Request $request){
        try {
            $body = $request->except('_token', 'agree');

            $validation = $this->validate->company($body, "create");

            if($validation->fails())
            {
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                \Session::put("red", true);
                return redirect()->back()->withErrors($errorMessages);
            }else {

                $body["slug"] = str_random(10);

                // make user account in active till email is verified
                $body['isActive'] = 0;

                $body['type'] = "company";

                //encrypt password string
                $body["password"] = bcrypt($body["password"]);

//                $body["type"] = "company";
                //store create the user info

                $body['id'] = $this->user->create($body)->id;

                //remove passwords from request body
                unset($body["password"]);
                unset($body["password_confirmation"]);

                $snd = [
                    "email" => $body["email"],
                ];

                $this->getSignUpCode($snd);


                $params = [
                    "name" => $body["companyName"],
                    "address" => $body["companyAddress"],
                    "email" => $body["companyEmail"],
                    "slug" => str_random(10),
                    "userId" => $body["id"],
                ];

                $this->company->create($params);

                \Session::put("green", true);
                \Session::forget('email');
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

        //save the details
        $this->codes->create($body);

        //send code to the user
        $this->mail->sendSignUpCode($body);
    }

    public function editProfile(Request $request){
        try{
            $body = $request->except('_token');

            $validation = $this->validate->company($body, "update");

            if($validation->fails())
            {
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                \Session::put("red", true);
                return redirect()->back()->withErrors($errorMessages);
            }else {
                $query = $this->company->where('slug', $body["slug"]);

                $params = [

                ];

                if($query->first() !== null){
                    $query->update($params);
                }else{

                }
            }

        } catch (\Exception $e){
            \Session::put("red", true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function editInfo(Request $request){
        try{
            $body = $request->except("_token");

            $validation = $this->validate->company($body, "update");
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
                    $company = $this->company->where('slug', $body['companySlug']);
                    if($company->first() === null){
                        \Session::put('red', true);
                        return redirect()->back()->withErrors("An Error Occured");
                    } else {
                        $company->update([
                            'name' => $body["companyName"],
                            'address' => $body["companyAddress"],
                            'accountNumber' => $body["accountNumber"],
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

<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Http\Helpers\Helper;
use App\Http\Helpers\Validate;
use App\Http\Helpers\sendMail;
use App\Models\User;
use App\Models\Code;
use Illuminate\Support\Facades\Session;
class LoadController extends Controller
{
    private $auth;
    private $user;
    private $helper;
    private $codes;
    private $validate;
    private $mail;

    public function __construct(Auth $auth, User $user, Helper $helper, Validate $validate, Code $codes, sendMail $mail) {
        $this->auth = $auth;
        $this->user = $user;
        $this->helper = $helper;
        $this->codes = $codes;
        $this->validate = $validate;
        $this->mail = $mail;
    }

        public function signIn(Request $request){
            try{
//                dd("Hi");
                $body = $request->all();

                $validation = $this->validate->auth($body, "login");

                if($validation->fails())
                {
                    $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                    \Session::put("red", true);
                    return redirect()->back()->withErrors($errorMessages);
                }else {
                    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                        //begin: Authentication passed...
//                        dd($request->all());
                        $getUser = $this->user->where("email", $request->email)->first();
                        if($getUser->isActive == false){
                            return redirect('auth/logout?invalid=true')->withErrors("Please check your email for a verification code");
                        } else {
                            if($getUser->type == "company") {

                                return redirect('company/dashboard');

                            } elseif ($getUser->type == "admin"){
                                return redirect('admin/'.$getUser->slug.'/dashboard');

                            } elseif ($getUser->type == "consultant" || $getUser->type == "realtor"){

                                return redirect('agency/dashboard');

                            } else{
                                return redirect('user/dashboard');

                            }
                        }

                        // end;

                    } else {
                        // begin: Damn It
                        \Session::put("red", true);
                        return redirect()->back()->withErrors("Incorrect Login Details");
                    }
                }
            } catch (\Exception $e){
                \Session::put("red", true);
                return redirect()->back()->withErrors($e->getMessage());
            }
        }

        public function signUp(Request $request){
            try {
                $body = $request->except('_token', 'agree');

                $validation = $this->validate->auth($body, "signup");

                if($validation->fails())
                {
                    $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                    \Session::put("red", true);
                    return redirect()->back()->withErrors($errorMessages);
                }else {
                    $body["slug"] = str_random(10);

                    // make user account in active till email is verified
                    $body['isActive'] = 0;

                    //encrypt password string
                    $body["password"] = bcrypt($body["password"]);
                    //store create the user info
                    $body['id'] = $this->user->create($body)->id;

                    //remove passwords from request body
                    unset($body["password"]);
                    unset($body["password_confirmation"]);

                    $params = [
                        "email" => $body["email"],
                        "fullName" => $body["name"],
                    ];

                     $this->getSignUpCode($params);

                    \Session::put("green", true);
                    return redirect()->back()->withErrors("Account created successfully, Please check your email for verification");
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
        public function getWithCode($body)
        {
            //generate a six digit code and add to request body

            $body["code"] = mt_rand(350000, 999999);

            //save the details
            $this->codes->create($body);

            //send code to the user
            $this->mail->sendWithCode($body);
        }

        public function logout(Request $request){
            try{

                if($request->has('invalid')){

                    \Session::flush();
                    Auth::logout();
                    \Session::put("red", true);
                    return redirect('auth/login')->withErrors("Please check your email for a verification url");
                } else{
                    \Session::flush();
                    Auth::logout();
                    return redirect('auth/login');
                }

            } catch (\Exception $e){

                \Session::put("red", true);
                return redirect()->back()->withErrors($e->getMessage());

            }
        }

    public function sendSignUpCode(Request $request)
    {
        try {

            $body = $request->except('_token');

            //validate the request body
            $validation = $this->validate->auth($body, "code");

            if($validation->fails())
            {
                //format the error messages
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                //return validation error
                return response()->json(["message" => $errorMessages, "data" => $body, "error" => true], 403);
            } else {
                //generate a six digit code and add to request body
                $body["code"] = mt_rand(350000, 999999);

                $body["email"] = $request->email;

                //send code to the user
                $this->getSignUpCode($body);

                //it's a wonderful world
                return response()->json(["message" => "Sign-up code was sent successfully", "data" => $request->all()], 200);
            }
        } catch(\Exception $e) {
            return response()->json(["message" => $e->getMessage(), "data" => $request->all()], 500);
        }
    }

    public function sendWithCode(Request $request)
    {
        try {

            $body = $request->except('_token');

            //validate the request body
            $validation = $this->validate->auth($body, "code");

            if($validation->fails())
            {
                //format the error messages
                $errorMessages = $this->helper->formatErrors($validation->getMessageBag()->messages());

                //return validation error
                return response()->json(["message" => $errorMessages, "data" => $body, "error" => true], 403);
            } else {
                //generate a six digit code and add to request body
                $body["code"] = mt_rand(350000, 999999);

                $body["email"] = $request->email;

                //send code to the user
                $this->getWithCode($body);

                //it's a wonderful world
                return response()->json(["message" => "Sign-up code was sent successfully", "data" => $request->all()], 200);
            }
        } catch(\Exception $e) {
            return response()->json(["message" => $e->getMessage(), "data" => $request->all()], 500);
        }
    }

    public function useSignUpCode(Request $request)
    {
        try {
            //get request body
//            dd("Hi");
            if($request->has("dash")) {
                $body = $request->except('_token', 'dash');
            } else{
                $body = $request->except('_token');
            }
            //confirm sign up code
            $findCode = $this->codes->where("code", $body["code"])->first();

            if($findCode !== null) {
                if($findCode->used == false) {
                    //use the code
                    $this->codes->where($body)->update(["used" => true]);
                    if($request->has("dash")) {
                        $this->user->where("email", $findCode->email)->update(["isActive" => true]);
                    }
                } else {
                    if($request->has("dash")){
                        \Session::put('red', true);
                        return redirect()->back()->withErrors("Code already used");
                    }else{
                        return response()->json(["message" => "Code already used", "data" => $body, "error" => true], 403);
                    }
                }
            } else {
                //code not found
                if($request->has("dash")){
                    \Session::put('red', true);
                    return redirect()->back()->withErrors("Invalid code provided");
                }else{
                    return response()->json(["message" => "Invalid code provided", "data" => $body, "error" => true], 404);
                }
            }

            //smile! life is not hard.
            if($request->has("dash")){
                \Session::put('green', true);
                return redirect()->back()->withErrors("Email verified successfully");
            }else{
                \Session::put('email', $findCode->email);
                return response()->json(["message" => "Email verified successfully", "data" => $body, "error" => false], 200);
            }
        } catch(\Exception $e) {

            if($request->has("dash")){
                \Session::put('red', true);
                return redirect()->back()->withErrors($e->getMessage());
            }else{
                return response()->json(["message" => $e->getMessage(), "error" => true], 500);
            }
        }
    }

    public function verifyCode(Request $request){
        try {
            $code = base64_decode($request->code);
            //confirm sign up code
            $findCode = $this->codes->where("code", $code)->first();

            $body = [
                "code" => $code,
                "used" => false,
            ];

            if($findCode !== null) {
                if($findCode->used == false) {
                    //use the code
                    $this->codes->where($body)->update(["used" => true]);

                    $this->user->where("email", $findCode->email)->update(["isActive" => true]);
                } else {
                    \Session::put('red', true);
                    return redirect()->back()->withErrors("Code already used");
                }
            } else {
                \Session::put('red', true);
                return redirect()->back()->withErrors("Invalid code provided");
            }

            \Session::put('green', true);
            return redirect()->back()->withErrors("Email verified successfully");
        } catch(\Exception $e) {
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

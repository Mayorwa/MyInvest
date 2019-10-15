<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Helpers\Validate;
use App\Http\Helpers\Helper;
use Illuminate\Support\Facades\Hash;

class LoadController extends Controller
{
    //
    private $user;
    private $validate;
    private $helper;
    public function __construct(User $user, Validate $validate, Helper $helper){
        $this->user = $user;
        $this->validate = $validate;
        $this->helper = $helper;
    }

    public function editInfo(Request $request){
        try{
            $body = $request->except("_token");

            $validation = $this->validate->user($body, "update");
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
                    \Session::put('green', true);
                    return redirect()->back()->withErrors("Account Updated Successfully");
                }
            }
        } catch(\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    public function changePassword(Request $request){
        try{
            $body = $request->except("_token");

            $validation = $this->validate->user($body, "change_password");
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
                    $usr = $user->first();
                    if (Hash::check($body['currentPassword'], $usr->password)) {
                        $user->update([
                            'password' => bcrypt($body["password"]),
                        ]);
                        \Session::put('green', true);
                        return redirect()->back()->withErrors("Password Updated Successfully");
                    }else{
                        \Session::put('red', true);
                        return redirect()->back()->withErrors("Wrong password inputted");
                    }
                }
            }
        } catch (\Exception $e){
            \Session::put('red', true);
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}

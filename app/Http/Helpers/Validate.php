<?php

namespace App\Http\Helpers;

use Validator;

class Validate {
    private $validator;

    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    public function auth($data, $type)
    {

        if($type == "code")
        {
            return $this->validator::make($data, ["email" => "required|unique:codes|email"]);
        }elseif($type == "reset-password") {
            return $this->validator::make($data, [
                "token" => "required",
                "password" => "required|min:6|confirmed",
            ]);
        }elseif($type == "login") {
            return $this->validator::make($data, [
                "email" => "required",
                "password" => "required|min:6",
            ]);
        }elseif($type == "recovery-link") {
            return $this->validator::make($data, [
                "email" => "required",
                "target" => "required",
            ]);
        } else {
            return $this->validator::make($data, [
                "name" => "required",
                "address" => "required",
                "phone" => "required|unique:users",
                "dob" => "required",
                "email" => "required|unique:users",
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6',
                'nextOfKin' => "required",
                'nextOfKinPhone' => "required|unique:users",
                'nextOfKinEmail' => "required|unique:users",
            ]);
        }
    }

    public function company($data, $type)
    {

        if($type == "create")
        {
            return $this->validator::make($data, [
                "name" => "required",
                "companyName" => "required",
                "companyAddress" => "required",
                "companyEmail" => "required",
                "phone" => "required|unique:users",
                "dob" => "required",
                "address" => "required",
                "email" => "required|unique:users",
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6',
                'nextOfKin' => "required",
                'nextOfKinPhone' => "required|unique:users",
                'nextOfKinEmail' => "required|unique:users",
            ]);
        }
        elseif($type == "update"){
            return $this->validator::make($data, [
                "name" => "required",
                "dob" => "required",
                "phone" => "required|unique:users",
                "address" => "required",
                "slug" => "required",
                "companySlug" => "required",
                "companyName" => "required",
                "companyAddress" => "required",
                "accountNumber" => "required",
            ]);
        }
    }

    public function user($data, $type){
        if($type == "update")
        {
            return $this->validator::make($data, [
                "name" => "required",
                "dob" => "required",
                "phone" => "required|unique:users",
                "address" => "required",
                "slug" => "required",
            ]);
        }
        elseif($type == "change_password"){
            return $this->validator::make($data, [
                "slug" => "required",
                "currentPassword" => "required",
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6'
            ]);
        }
    }

    public function estate($data, $type){
        if($type == "create")
        {
            return $this->validator::make($data, [
                "name" => "required",
                "size" => "required",
                "companyId" => "required",
                "noOfPlots" => "required",
                "amount" => "required",
                "bio" => "required",
                "additionalFees" => "required",
                "address" => "required",
                "state" => "required",
                "country" => "required",
                "rules" => "required",
                "description" => "required",
            ]);
        }
    }

    public function premium($data, $type){
        if($type == "create")
        {
            return $this->validator::make($data, [
                "name" => "required",
                "size" => "required",
                "companyId" => "required",
                "noOfPlots" => "required",
                "amount" => "required",
                "bio" => "required",
                "additionalFees" => "required",
                "address" => "required",
                "state" => "required",
                "country" => "required",
                "rules" => "required",
                "description" => "required",
            ]);
        }
    }

    public function trnx($data, $type){
        if($type == "register")
        {
            return $this->validator::make($data, [
                "itemId" => "required",
                "amount" => "required",
                "userId" => "required",
            ]);
        }
    }
    public function agency($data, $type){
        if($type == "create")
        {
            return $this->validator::make($data, [
                "name" => "required",
                "companyId" => "required",
                "phone" => "required|unique:users",
                "dob" => "required",
                "address" => "required",
                "email" => "required|unique:users",
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required|min:6',
                'nextOfKin' => "required",
                'nextOfKinPhone' => "required|unique:users",
                'nextOfKinEmail' => "required|unique:users",
            ]);
        }
        elseif($type == "update"){
            return $this->validator::make($data, [
                "name" => "required",
                "dob" => "required",
                "phone" => "required|unique:users",
                "address" => "required",
                "agencySlug" => "required",
                "slug" => "required",
                "accountNumber" => "required",
            ]);
        }
    }
}

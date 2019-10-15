<?php

namespace App\Http\Helpers;

use Carbon\Carbon;
use Stillat\Numeral\Languages\LanguageManager;
use Stillat\Numeral\Numeral;


class Helper {

    private function getPath()
    {

        $basePath = public_path()."";

        return $basePath;
    }

    public function formatErrors($messages)
    {
        $errors = [];
        foreach ($messages as $key => $value) {
            array_push($errors, $value);
        }

        return $errors;
    }

    public function saveExpiryTime($token)
    {
        //get current time in hours
        $currentTime = date("H:i");

        //add 20 mins to the current time to make the link expire after 20mins
        //the timeout is configurable with env variables, you can just replace
        //the value with the variable of your choice.
        $expiryTime = date('H:i',strtotime('+20 minutes',strtotime($currentTime)));

        //store the values in an array
        $timeData = [
            'token' => $token,
            'time'  => $expiryTime,
        ];

        return $timeData;
    }
    public function generateToken()
    {
        $date = strtotime(date("YmdHms"));

        $token = strtoupper(substr($date, 0, 5).str_random(10).substr($date, 5, 10));

        return $token;
    }

    public function uploadFile($file, $type, $base64 = false)
    {

            //get the file extension
            $extension = $file->getClientOriginalExtension();

            switch ($type) {
                case 'propertyImage':
                    $uploadPath = "/uploads/images/";
                    $destinationPath = $this->getPath().$uploadPath;
                    $filename = "prop_".str_random(10).'.'.$extension;
                    $file->move('uploads/images', $filename);

                    return ["file" => $filename, "path" => $destinationPath];
                    break;
                default:
                    # code...
                    break;
            }
    }

    public static function MoneyConvert($cash, $type = null){
        $languageManager = new LanguageManager;
        // Create the Numeral instance.

        $formatter = new Numeral;
        // Now we need to tell our formatter about the language manager.

        $formatter->setLanguageManager($languageManager);

        if($type == "full"){
            $string = $formatter->format($cash, '0,0.00');
        }
        else {
            $string = $formatter->format($cash, '0,0a');
        }
        return $string;
    }
    public static function dataTime($data){
        $date = Carbon::parse($data);
        return $date->toDayDateTimeString('MMMM Do YYYY, h:mm:ss a');
    }

    public static function singular($data){
        $date = Carbon::parse($data);
        return $date->diffForHumans();
    }
}

<?php

namespace App\Http\Helpers;

class apiHelper
{
    private function config()
    {
        //get environment
        $environment = env('APP_ENV');

        $baseUrl = env('PAYSTACK_PAYMENT_URL');

        $token = env('PAYSTACK_SECRET_KEY');

        //check for apiToken

        $apiToken = 'Bearer ' . $token;


        $config = [
            'baseUrl' => $baseUrl,
            'apiToken' => $apiToken,
        ];
        return $config;
    }

    public function call($url, $verb, $body = null, $debug = null, $customHeader = null, $external = false)
    {
        $getConfig = $this->config();

        $uri = ($external == true) ? $url : $getConfig['baseUrl'] . $url;

        $headers = ['Authorization: ' . $getConfig['apiToken']];

        if ($customHeader != null) {
            array_push($headers, $customHeader);
        }

        $ch = curl_init($uri);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $verb);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        if ($verb === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
        }

        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLINFO_HTTP_CODE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $result = curl_exec($ch);

        $response = json_decode($result);


        if($debug == true) {
            dd($uri, $response, $body, $verb, $headers);
        }

        //get the curl info
        $responseInfo = curl_getinfo($ch);

        //close curl operation after successful run.
        curl_close($ch);

        if ($response !== null) {
            if ($responseInfo['http_code'] !== 0) {
                //add the response code to response body
                $response->http_code = $responseInfo['http_code'];
            } else {
                $response->http_code = 500;
            }
        } else {
            dd($uri, $verb, $body, $responseInfo['http_code']);
        }

        //return the response to controller
        return $response;
    }


    public function processPayment($data){
        $ver = $this->call('/transaction/verify/'.$data["reference"], 'GET');

        if($ver->status == true){
            $verTransctions = $ver->data;
            $auth_code = $verTransctions->authorization->authorization_code;

            $customer_code = $verTransctions->customer->customer_code;
        }

        $creatpParams = [
            "name" => $data["name"],
            "interval" => "monthly",
//            "interval" => "monthly",
            "amount" => $data["amount"],

        ];

        $cPlan = $this->call('/plan', 'POST', $creatpParams);

        if($cPlan->status == true){
            $plansData = $cPlan->data;
            $plan_code = $plansData->plan_code;
        }

        $creatsParams = [
            "customer_code" => $customer_code,
            "plan_code" => $plan_code,
            "auth_code" => $auth_code,
        ];
        $cSub = $this->call('/subscription', 'POST', $creatsParams);

        if($cSub->status == true){
            $subData = $cSub->data;
            $finalDta = [
                "sub_code" => $subData->subscription_code,
                "email_token" => $subData->email_token
            ];
        }
        return $finalDta;
    }
}

<?php

namespace App\Http\Helpers;
use Mail;
use PDF;
use Sabberworm\CSS\Value\URL;

class sendMail {

    private $mail;

    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    public function welcomeMessage($data)
    {
        //get the user's first name from the fullname value
        $firstName = $data['fullName'];

        $mail["title"] = "Welcome to ".env('APP_NAME');
        $mail["salute"] = "Hello ".$firstName.",";

        $mail["message"] = "<center>Thank you for joining ".env('APP_NAME');
        $mail["message"] .= "<br>You can have an introduction of your app here, really express yourself";
        $mail["message"] .= "<br>because here is where you get to explain yourself, paint a picture";
        $mail["message"] .= "<br>of the capability of your app to the user";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject($mail['title']);
        });
    }

    public function sendSignUpCode($data)
    {
        $code = $data["code"];
        $mail["salute"] = "Hi there!";
        $mail["message"] = "You can verify your account by clicking on the link below".env('SITE_URL');
        $mail["buttonTitle"] = "Accept Invite";
        $mail["targetUrl"] = URL("/verification/")."/".base64_encode($data["code"]);
        $mail["title"] = "Myycrib Activation Code";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject('Myycrib Activation Code');
        });
    }

    public function sendWithCode($data)
    {
        $mail["salute"] = "Hi there!";
        $mail["message"] = "Below you will find your account activation code to complete your registration on ".env('SITE_URL');
        $mail["message"] .= "<br><h3>".$data["code"]."</h3>";
        $mail["title"] = "Myycrib Activation Code";
        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data['email'])->subject('Myycrib Activation Code');
        });
    }

    public function Reciept($data) {

        $invtemp = 'vis' .$data['slug']. 'invtemp.pdf';
        // PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView("emails.reciept", ['data' => $data])->save(public_path().'/uploads/reciept/'.$invtemp);


        $mail["salute"] = "Hello ".($data["name"]);
        $mail["message"] = "Your Invoice has been created and You can download it by clicking on the link below";
        $mail["message"] .= "<br>Click the button below to view the invoice";
        $mail["title"] = "Property Receipt";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data, $invtemp)
        {
            $m->from(env('SENDER_EMAIL'), env('SENDER_NAME'));
            $m->to($data["email"])->subject($mail['title']);
            $m->attach(public_path().'/uploads/reciept/'.$invtemp);
        });

    }

    public function sendContactUs($data){
        $mail["salute"] = $data["subject"];
        $mail["message"] = $data["message"];
        $mail["title"] = "Message From MyyInvest ( ".$data["subject"]. " )";

        $this->mail::send('emails.template', ['data' => $mail], function ($m) use ($mail, $data) {
            $m->from($data['email'], $data['name']);
            $m->to(env('SENDER_EMAIL'))->subject("Message From MyyInvest ( ".$data["subject"]. " )");
        });
    }

}

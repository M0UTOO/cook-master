<?php

namespace App\Controllers;

class SendMail extends BaseController
{
    function __construct() {
        helper('session');
        helper('form');
    }

    public function index()
    {
        $data['name'] = "John Doe";
        return view('users/templateWelcomeMailClient', $data);
    }

    private function sendMailResetPassword($to, $link){
        $this->sendMail($to, "Reset your password", view('password/templateResetPasswordMail'), "Reset your password");
    }

    public function sendWelcomeMail($to, $userType, $name) :bool{
        echo "ok";
        $data['name'] = isset($name) ? $name : "future cook master";
        $mail = $userType == "Client" ? view('users/mails/templateWelcomeMailClient', $data) : view('users/mails/templateWelcomeMailOthers', $data);
        return $this->sendMail($to, "Welcome to Cookmaster", $mail, "Cookmaster");
    }

    private function initializeMail(){
        $email = \Config\Services::email();
        $config['SMTPPass'] = env('SMTP_PASSWORD');
        $config['SMTPUser'] = env('SMTP_USER');
        return $email->initialize($config);
    }

    private function sendMail(string $to, string $subject, string $message, string $object): bool
    {
        $email = $this->initializeMail();
        $email->setTo($to);
        $email->setFrom('becomeacookmaster@gmail.com', $object);

        $email->setSubject($subject);
        $email->setMessage($message);

        if ($email->send()) {
            echo 'Email successfully sent';
            return true;
        } else {
            $data = $email->printDebugger(['headers']);
            print_r($data);
            return false;
        }
    }
}
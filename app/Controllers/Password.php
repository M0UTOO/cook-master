<?php

namespace App\Controllers;

class Password extends BaseController
{
    private string $password;

    public function __construct($string)
    {
        $this->password = $this->hashPassword($string);
    }

    public function forgottenPassword(){
        $data['title'] = "Forgotten password";
        return view('password/forgottenPassword', $data);
    }

    public function resetPassword(){
        //TODO:CHECK IF EMAIL IS IN THE DATABASE
        //TODO: SEND NEW PASSWORD TO API
    }

    public function sendMailResetPassword(){
        //TODO:
    }

    public function hashPassword($password){
        return password_hash($password, PASSWORD_BCRYPT); //New hash every time
    }


    public function __toString()
    {
        return $this->password;
    }


}
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

    public function checkPassword(){
        //TODO: CHECK IF PASSWORD IS CORRECT (CHECKING DONE IN JS FIRST)
    }

    public function hashPassword($password){
        //TODO:HASH THE PASSWORD BEFORE SENDING IT TO THE API.
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function decodeHashPassword($password){
        //TODO:UNHASH THE PASSWORD WHEN RECEIVING IT FROM THE API.
    }

    public function __toString()
    {
        return $this->password;
    }


}
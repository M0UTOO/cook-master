<?php

namespace App\Controllers;

class SignIn extends BaseController
{
    public function signIn(){

        $data['title'] = "Sign In";
        $data['mini'] = true; //TO SHOW THE MINI SIGNUP FORM

        if (isLoggedIn()){
            $data['message'] = "You are already logged in";
            return view('users/index', $data);
        }
        elseif (!$this->request->is('post')){
            return view('signin/signIn', $data);
        }
        else {
            //VALUES FROM FORM
            $email = $this->request->getPost(['email']);
            $password = ($this->request->getPost(['password']))['password'];

            //GET HASHED PASSWORD
            $hashPassword = callAPI('/user/password', 'post', $email);

            if ($hashPassword['error']){
                $data['message'] = $hashPassword['message'];
                return view('signin/signIn', $data);
            } else {
                $hashPassword = $hashPassword['password'];

                //CHECK PASSWORD MATCH
                if (!password_verify($password, $hashPassword)){
                    $data['message'] = "Wrong password";
                    return view('signin/signIn', $data);
                } else {
                    $password = $hashPassword;

                    $logins =
                        [
                            'email' => $email['email'],
                            'password' => $password,
                        ];

                    $data['message'] = callAPI('/user/login', 'post', $logins);

                    if ($data['message']['error']){
                        $data['message'] = $data['message']['message'];
                        return view('signin/signIn', $data);
                    }

                    #SESSION#
                    if (isset($data['message']['id'])) {
                        if (isset($data['message']['isblocked']) && $data['message']['isblocked'] != "not blocked"){
                            $data['message'] = "You've been blocked, you can't log in anymore. Contact an administrator or come back in 30min if you've enter wrong password too much.";
                            return redirect()->to('/signIn')->with('message', $data['message']);

                        }
                        else
                        {
                            $userInfo = [
                                'id' => $data['message']['id'],
                                'role' => $data['message']['role'],
                                'isLoggedIn' => true,
                                'isblocked' => false
                            ];

                            if (isset($data['message']['subscription'])) {
                                $userInfo['subscription'] = callAPI('/subscription/'.$data['message']['subscription'], 'get');
                                if(isset($userInfo['subscription']['error'])){
                                    return redirect()->to('/')->with('message', $userInfo['subscription']['message']);
                                } else {
                                    unset($userInfo['subscription']['picture']);
                                    unset($userInfo['subscription']['description']);
                                }
                            }
                            $session = session();
                            $session->set($userInfo);
                            $data['message'] = "You are now logged in";
                        }
                    }
                    return redirect()->to('/')->with('message', $data['message']);
                }
            }
        }
    }

    public function signOut(){

        if (!isLoggedIn()){
            $data['message'] = "You are not logged in";
        }
        else
        {
            $session = session();
            $session->destroy();

            $data['title'] = "Sign Out";
            $data['message'] = "You are now logged out";
        }
        return redirect('/')->with('message', $data['message']);
    }
}
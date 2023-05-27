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

            $logins = $this->request->getPost(['email', 'password']);
            $data['message'] = callAPI('/user/login', 'get', $logins);

            if ($data['message']['error']){
                $data['message'] = $data['message']['message'];
                return view('signin/signIn', $data);
            }

            #SESSION#
            if (isset($data['message']['id'])) {
                $userInfo = [
                    'id' => $data['message']['id'],
                    'role' => $data['message']['role'],
                    'isLoggedIn' => true,
                ];
                $session = session();
                $session->set($userInfo);

                $data['message'] = "You are now logged in";
            }
            return redirect('/');
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
        return redirect('/')->with('message', $data['message']); //doesn't display message ?
    }
}
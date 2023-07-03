<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
    }

    public function signUp(){

        $data['title'] = "Sign Up";
        $data['isManager'] = isManager();

        if (isLoggedIn()){
            $data['message'] = "You are already logged in";
            return redirect()->to('/')->with('message', $data['message']);
        }
        else if ($this->request->getPost('mini')){
            $data['mini'] = false; //TO SHOW THE FULL FORM AND NOT THE MINI ONE
            $data['email'] = $this->request->getPost('email');//TO ADD THE EMAIL AUTOMATICALLY IN NEXT PAGE

            return view('users/signUp', $data);

        }
        elseif (!$this->request->is('post')){

            $data['userType'] = "Client";
            return view('users/signUp', $data);
        }
        else
        {
            $values = $this->request->getPost();

            if ($values['password'] != $values['password-confirm']){
                $data['message'] = "Passwords don't match";
                return view('users/signUp', $data);
            } else {
                unset($values['password-confirm']);
                $type = $values['Type'] ;
                unset($values['Type']);

                $subscriptions= callAPI('/subscription/all', 'get');

                    foreach ($subscriptions as $subscription) {
                        if ($subscription->price == 0) {
                            $default_subscription = $subscription->idsubscription;
                            break; // Stop the loop after finding the first match
                        }
                    }

                $values['subscription'] = $default_subscription;
                $values['language'] = (int)$values['language'];

                $tmp = new Password($values['password']);
                $values['password'] = $tmp->__toString();

                $data['message'] = callAPI('/user/', 'post', $values, ['Type' => $type]);
                return redirect()->to('/signIn')->with('message', $data['message']['message'] . " with free subscription");
            }

        }

    }

    private function getError(array $data, string $redirectionUrl): string{

        if ($data['message']['error']){
            $data['message'] = $data['message']['message'];
            return view($redirectionUrl, $data);
        } else {
            return "0";
        }
    }

    public function profile(){

        if (!isLoggedIn()){
            return redirect()->to('/signIn')->with('message', 'You need to be logged in to access this page');
        }

        $userId = session()->get('id');
        $data['user'] = callAPI('/user/'.$userId, 'get');
        $data['title'] = "My profile";

        return view('users/profile', $data);
    }


    public function edit($id){

        $data['user'] = callAPI('/user/'.$id, 'get');
        //TODO: SHOW SIGNUP FORM WITH USER DATA PRE-FILLED
        return view('users/profile', $data);
    }
    public function delete($id){
        //delete user from DB - NOT DONE YET BUT :
        echo $id;
        $data['message'] = callAPI('/user/'.$id, 'delete');
        return redirect()->to('/dashboard/userManagement')->with('message', $data['message']['message']);
    }

    public function block($id){
        helper('date');
        //blocked user can't login but data still here
        $time = date("Y-m-d H:i:s", now()); //TODO:CHECK TIME LOCATION
        $data['message'] = callAPI('/user/'.$id, 'patch', ['isblocked' => $time]);
        return redirect()->to('/dashboard/userManagement')->with('message', $data['message']['message']);
    }
}
<?php

namespace App\Controllers;

use CodeIgniter\I18n\Time;

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
            $picture = $this->request->getFile('profilepicture');

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
                $user_id = $data['message']['iduser'];

                //SAVE PROFILEPICTURE ON SERVER: PICTURE NAME IS TIMESTAMP TO NOT MAKE IT OBVIOUS TO FIND
                $picture_name = "img-".$user_id . "_" . date('Y_mdHis', (new Time())->now()->getTimestamp()) . "." . $picture->getExtension(); //check extension

                $data['state'] = callAPI('/user/'.$user_id, 'patch', ['profilepicture' => $picture_name]);

                if (!$data['state']['error']){
                    $directory = './assets/images/users';
                    if (!file_exists($directory)){
                        mkdir($directory, 755, true);
                        chmod($directory, 755);
                    }
                    $picture->move($directory, $picture_name);
                }
                return redirect()->to('/signIn')->with('message', $data['message']['message'] . ". Log in to start your cookmaster experience !");
            }

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
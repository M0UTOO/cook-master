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

                var_dump($values);
                //$data['message'] = callAPI('/user/', 'post', $values, ['Type' => $type]);
                // $user_id = $data['message']['iduser'];

                // //SAVE PROFILEPICTURE ON SERVER: PICTURE NAME IS TIMESTAMP TO NOT MAKE IT OBVIOUS TO FIND
                // $picture_name = "img-".$user_id . "_" . date('Y_mdHis', (new Time())->now()->getTimestamp()) . "." . $picture->getExtension(); //check extension

                // $data['state'] = callAPI('/user/'.$user_id, 'patch', ['profilepicture' => $picture_name]);

                // if (!$data['state']['error']){
                //     $directory = './assets/images/users';
                //     if (!file_exists($directory)){
                //         mkdir($directory, 755, true);
                //         chmod($directory, 755);
                //     }
                //     $picture->move($directory, $picture_name);
                }
                //return redirect()->to('/signIn')->with('message', $data['message']['message'] . ". Log in to start your cookmaster experience !");
            }
        }

    public function profile(){

        if (!isLoggedIn()){
            return redirect()->to('/signIn')->with('message', 'You need to be logged in to access this page');
        }

        $userId = session()->get('id');
        $data['user'] = callAPI('/user/'.$userId, 'get');
        $data['title'] = lang('Common.profile');

        if (isClient()){
            $data['client'] = callAPI('/client/'.$userId, 'get');
            $data['comingEvents'] = callAPI('/event/coming/'.$userId, 'get');
            $data['comments'] = callAPI('/comment/client/'.$userId, 'get');
            $data['bills'] = callAPI('/bill/user/'.$userId, 'get');
            $data['formations'] = callAPI('/event/formation/'.$userId, 'get');
            $data['pastEvents'] = callAPI('/event/past/'.$userId, 'get');
        } else if (isContractor()){
            $data['contractor'] = callAPI('/contractor/'.$userId, 'get');
            $data['type'] = callAPI('/contractor/type/'.$data['contractor']['contractortype'], 'get');
        } else if (isManager()){
            $data['manager'] = callAPI('/manager/'.$userId, 'get');
        }

        return view('users/profile', $data);
    }


    public function edit($id){

        $data['user'] = callAPI('/user/'.$id, 'get');
        return view('users/profile', $data);
    }
    public function delete($id, $role){
        $data['user']= callAPI('/user/'.$id, 'get');
        $data['message'] = callAPI('/user/'.$id, 'delete',[], ['Type' => $role]);
        if (!isset($data['message']['error']) && $data['user']['profilepicture'] != null){
            if ($data['user']['profilepicture'] != "default.png"){
                if (file_exists('./assets/images/users/'.$data['user']['profilepicture'])){
                    unlink('./assets/images/users/'.$data['user']['profilepicture']);
                } else {
                    $data['message']['message'] .= " but the profile picture couldn't be deleted";
                }
            }
        }
        return redirect()->to('/dashboard/userManagement')->with('message', $data['message']['message']);
    }

    public function block($id){
        helper('date');
        //blocked user can't login but data still here
        $time = date("Y-m-d H:i:s", now()); //TODO:CHECK TIME LOCATION
        $data['message'] = callAPI('/user/'.$id, 'patch', ['isblocked' => $time]);
        return redirect()->to('/dashboard/userManagement')->with('message', $data['message']['message']);
    }

    public function coming(){
        $data['title'] = "Coming events";
        $userId = session()->get('id');
        $data['events'] = callAPI('/event/coming/'.$userId, 'get');
        return view('users/coming', $data);
    }

    public function past(){
        $data['title'] = "Past events";
        $userId = session()->get('id');
        $data['events'] = callAPI('/event/past/'.$userId, 'get');
        return view('users/coming', $data);
    }

    public function comment(){
        $data['title'] = "My Comments";
        $userId = session()->get('id');
        $data['comments'] = callAPI('/comment/client/'.$userId, 'get');
        return view('users/comment', $data);
    }

    public function formation(){
        $data['title'] = "My Formations";
        $userId = session()->get('id');
        $data['formations'] = callAPI('/event/formation/get/'.$userId, 'get');
        return view('users/formation', $data);
    }

    public function certificate($idformation, $iduser) {
        $data['title'] = "My Certificate";
        $data['formation'] = callAPI('/event/group/get/'.$idformation, 'get');
        $data['client'] = callAPI('/client/'.$iduser, 'get');
        return view('users/certificate', $data);
    }

    public function account($id){
        if (!$this->request->is('post')){
            $data['title'] = lang('Common.changeinfo');
            $userId = session()->get('id');
            $data['iduser'] = $userId;
            if (isClient()) {
                $data['client'] = callAPI('/client/' . $userId, 'get');
            } else if (isContractor()) {
                $data['contractor'] = callAPI('/contractor/' . $userId, 'get');
            } else if (isManager()) {
                $data['manager'] = callAPI('/manager/' . $userId, 'get');
            }
            return view('users/account', $data);
        } else {
            $picture = $this->request->getFile('picture');
            $values = $this->request->getPost();
            $iduser = $values['user_id'];
            unset($values['user_id']);
            if (isset($values['password'])) {
                $tmp = new Password($values['password']);
                $values['password'] = $tmp->__toString();
            }
            if (isset($values['keepSubscription'])){
                $values['keepSubscription'] = (int)$values['keepSubscription'];
            }
            if (isset($values['email'] )){
                $user['email'] = $values['email'];
            }
            if (isset($values['password'] )){
                $user['password'] = $values['password'];
            }
            if (isset($values['firstname'] )){
                $user['firstname'] = $values['firstname'];
            }
            if (isset($values['lastname'] )){
                $user['lastname'] = $values['lastname'];
            }
            if (isset($values['streetname'] )){
                $client['streetname'] = $values['streetname'];
            }
            if (isset($values['country'] )){
                $client['country'] = $values['country'];
            }
            if (isset($values['city'] )){
                $client['city'] = $values['city'];
            }
            if (isset($values['streetnumber'] )){
                $client['streetnumber'] = $values['streetnumber'];
            }
            if (isset($values['phonenumber'] )){
                $client['phonenumber'] = $values['phonenumber'];
            }
            if (isset($values['keepSubscription'] )){
                $client['keepsubscription'] = $values['keepSubscription'];
            }
            if (isset($values['presentation'] )){
                $contractor['presentation'] = $values['presentation'];
            }
            if (!empty($picture->getName()) && $picture->getSize() <= 2000000) {

                $picture_name = "img-event-".$iduser.".". $picture->getExtension(); //check extension
                $user['profilepicture'] = $picture_name;

            } else {
                return redirect()->to('/user/profile/account/' . $iduser . '')->with('message', 'wrong picture');
            }

            $data['message'] = callAPI('/user/'.$iduser, 'patch', $user);
            if ($data['message']['message'] == "user updated") {

                if (isset($picture) && $picture->isValid()) {
                    $directory = './assets/images/users';
                    if (!file_exists($directory)){
                        mkdir($directory, 755, true);
                        chmod($directory, 755);
                    }
                    if (file_exists($directory . '/' . $picture_name)){
                        unlink($directory . '/' . $picture_name);
                    }
                    $picture->move($directory, $picture_name);
                }
                if (isClient()) {
                    $data['message'] = callAPI('/client/'.$iduser, 'patch', $client);
                } else if (isContractor()) {
                    $data['message'] = callAPI('/contractor/'.$iduser, 'patch', $contractor);
                }
                return redirect()->to('/user/profile')->with('message', $data['message']['message']);
            } else {
                return redirect()->to('/user/profile')->with('message', $data['message']['message']);
            }
        }
    }
}
<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
    }

    public function isManager(): bool{
        return (session()->get('role') == 'manager');
    }
    public function isContractor(): bool{
        return (session()->get('role') == 'contractor');
    }
    public function isClient(): bool{
        return (session()->get('role') == 'client');
    }

    public function isSuperAdmin(): bool
    {
        //GET IT FROM THE FIELD IS_SUPER_ADMIN FROM MANAGER
        return true;
    }

    public function signIn(){
        helper('curl_helper');
        helper('session');

        $data['title'] = "Sign In";
        $data['mini'] = true; //TO SHOW THE MINI SIGNUP FORM

        if ((session()->get('id')) !== null ){
            $data['message'] = "You are already logged in";
            return view('users/index', $data);
        }
        elseif (!$this->request->is('post')){
            return view('users/signIn', $data);
        }
        else {

            $logins = $this->request->getPost(['email', 'password']);
            $data['message'] = callAPI('/user/login', 'get', $logins);

            if ($data['message']['error']){
                    $data['message'] = $data['message']['message'];
                    return view('users/signIn', $data);
            }

            #SESSION#
            if (isset($data['message']['id'])) {
                $userInfo = [
                    'id' => $data['message']['id'],
                    'role' => $data['message']['role'],
                ];
                $session = session();
                $session->set($userInfo);

                $data['message'] = "You are now logged in";
            }
            return view('users/index', $data);
        }
    }
    public function signUp(){
        helper('curl_helper');

        $data['title'] = "Sign Up";

        if (!$this->request->is('post')){
            return view('users/signUp', $data);
        }

        //IF USER WAS ON SMALL FORM AND NEEDS TO CREATE A FULL ACCOUNT NOW
        if ($this->request->getPost('mini')){
            $data['mini'] = false; //TO SHOW THE FULL FORM AND NOT THE MINI ONE
            $data['email'] = $this->request->getPost('email');
            //ADD THE EMAIL AUTOMATICALLY IN NEXT PAGE
            return view('users/signUp', $data);
        }

        $newUser= $this->request->getPost(['email', 'password', "and so on"]);
        //	a user:
        //        Email string `json:"email"`
        //			Password string `json:"password"`
        //			FirstName string `json:"firstname"`
        //			LastName string `json:"lastname"`
        //			FidelityPoints int `json:"fidelitypoints"`
        //			StreetName string `json:"streetname"`
        //			Country string `json:"country"`
        //			City string `json:"city"`
        //			SteetNumber int `json:"streetnumber"`
        //			PhoneNumber string `json:"phonenumber"`
        //			Subscription int `json:"subscription"`
        //			Presentation string `json:"presentation"`
        //			IsItemManager bool `json:"isitemmanager"`
        //			IsClientManager bool `json:"isclientmanager"`
        //			IsContractorManager bool `json:"iscontractormanager"`
        //			IsSuperAdmin bool `json:"issuperadmin"`

        //NEED TO TEST THIS :
        //$data['message'] = callAPI("/users/","post", $newUser);

        //$this->getError($data, 'users/signUp');

        return view('users/index', $data);
    }
    public function signOut(){
        helper('session');

        $session = session();
        $session->destroy();

        $data['title'] = "Sign Out";
        $data['message'] = "You are now logged out";

        return view('users/index', $data);
    }

    private function getError(array $data, string $redirectionUrl): string{

        if ($data['message']['error']){
            $data['message'] = $data['message']['message'];
            //var_dump($data) ;
            return view($redirectionUrl, $data);
        } else {
            return "0";
        }
    }

    public function profile(){

        helper('curl_helper');

        $userId = session()->get('id');
        echo $userId;
        //$data['user'] = callAPI('/user/'.$userId, 'get', []);
        //$data['events'] = getUsersEvents($data['user']['id']);
        $data['title'] = "My profile";
        //var_dump($data);
        //return view('users/profile', $data);
    }
    public function create()
    {
        $data['title'] = "nbvc";
//
//        helper('form');
//        //if form didn't get sent already, load form.
//        if (!$this->request->is('post')){
//            return view('users/index', $data);
//        }
//
//        $post = $this->request->getPost(['email', 'password']);
//
//        $data['email'] = $post['email'];
//        $data['password'] = $post['password'];

        return view('users/index', $data);
    }

    protected function getUsersEvents($id){
        //API CALL with $id
        return $events =
            [
                [
                    'id' => 1,
                    'name' => 'Event 1',
                    'date' => '2021-01-01',
                    'location' => 'Paris',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl vitae aliquam ultricies, nunc nisl ultricies nunc',
                ],
                [
                    'id' => 2,
                    'name' => 'Event 2',
                    'date' => '2021-01-02',
                    'location' => 'Paris',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla euismod, nisl vitae aliquam ultricies, nunc nisl ultricies nunc',
                ]
            ];
    }
}
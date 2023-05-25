<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
    }
    public function signIn(){

        $data['title'] = "Sign In";
        $data['mini'] = true; //TO SHOW THE MINI SIGNUP FORM

        if (isLoggedIn()){
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
            return redirect('/');
        }
    }
    public function signUp(){

        $data['title'] = "Sign Up";
        $data['isLoggedIn'] = isLoggedIn();
        $data['isManager'] = isManager();

        if (isLoggedIn()){
            $data['message'] = "You are already logged in";
            return view('users/index', $data);
        }
        else if ($this->request->getPost('mini')){
            $data['mini'] = false; //TO SHOW THE FULL FORM AND NOT THE MINI ONE
            $data['email'] = $this->request->getPost('email');//TO ADD THE EMAIL AUTOMATICALLY IN NEXT PAGE
            return view('users/signUp', $data);
        }
        elseif (!$this->request->is('post')){
            return view('users/signUp', $data);
        } else{
            $this->create($this->request->getPost());
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
        return redirect('users/index')->with('message', $data['message']); //doesn't display message ?
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

        $userId = session()->get('id');

        $data['user'] = callAPI('/user/'.$userId, 'get', []);
        //$data['events'] = getUsersEvents($data['user']['id']);
        $data['title'] = "My profile";
        $data['isLoggedIn'] = isLoggedIn();
        $data['isManager'] = isManager();
        //var_dump($data);
        return view('users/profile', $data);
    }

    public function create($values)
    {
        $data['title'] = "Create an account";
        $data['isLoggedIn'] = isLoggedIn();
        $data['isManager'] = isManager();
        $data['mini'] = false; //TO SHOW THE FULL FORM AND NOT THE MINI ONE

        helper('form');

        if (!$this->request->is('post')){
            return view('users/signUp', $data);
        }

        //TODO: CHECK THIS ! ROUTE NOT CREATE IN HERE.
        $data['message'] = callAPI('/user/', 'post', $this->request->getPost(), ['Type' => $values['type']]);

        return view('users/index', $data);
    }

    public function edit(){

    }
    public function delete(){

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
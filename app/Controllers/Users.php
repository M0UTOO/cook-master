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
            return view('users/index', $data);
        }
        else if ($this->request->getPost('mini')){
            $data['mini'] = false; //TO SHOW THE FULL FORM AND NOT THE MINI ONE
            $data['email'] = $this->request->getPost('email');//TO ADD THE EMAIL AUTOMATICALLY IN NEXT PAGE
           echo "ok";
            return view('users/signUp', $data);

        }
        elseif (!$this->request->is('post')){
            $data['userType'] = "Client";
            $data['subscriptions'] = callAPI('/subscription/all', 'get');
            return view('users/signUp', $data);
        }
        else
        {
            $values = $this->request->getPost();
            $type = $values['Type'] ;
            unset($values['Type']);

            $data['message'] = callAPI('/user/', 'post', $this->request->getPost(), ['Type' => $type]);

            return view('users/index', $data);
        }

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
        //blocked user can't login but data still here
        echo $id;
        $data['message'] = callAPI('/user/'.$id, 'patch', ['isblocked' => '2023-05-27']);
        return redirect()->to('/dashboard/userManagement')->with('message', $data['message']['message']);
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
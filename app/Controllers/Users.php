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
            return view('users/signUp', $data);
        }
        elseif (!$this->request->is('post')){
            $data['userType'] = "Client";
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

        $userId = session()->get('id');

        $data['user'] = callAPI('/user/'.$userId, 'get', []);
        //$data['events'] = getUsersEvents($data['user']['id']);
        $data['title'] = "My profile";
        $data['isManager'] = isManager();
        //var_dump($data);
        return view('users/profile', $data);
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
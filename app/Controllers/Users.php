<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
    }

    public function isManager(): bool{
        return true;
    }
    public function isContractor(): bool{
        return true;
    }

    public function isSuperAdmin(): bool
    {
        return true;
    }

    public function profile(){

        helper('curl_helper');

        $data['user'] = callAPI('/user/1', 'get', '');
        //$data['events'] = getUsersEvents($data['user']['id']);
        $data['title'] = "My profile";
        //var_dump($data);
        return view('users/profile', $data);
    }
    public function create()
    {
        $data['title'] = "Sign Up";
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
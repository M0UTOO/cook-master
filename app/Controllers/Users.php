<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index()
    {
    }

    public function profile(){
    //TODO: FETCH DATA FROM API and make it available to the view.
    }
    public function create()
    {
        $data['title'] = "Form to create user";

        helper('form');
        //if form didn't get sent already, load form.
        if (!$this->request->is('post')){
            return view('users/index', $data);
        }

        $post = $this->request->getPost(['email', 'password']);

        $data['email'] = $post['email'];
        $data['password'] = $post['password'];

        return view('users/index', $data);
    }
}
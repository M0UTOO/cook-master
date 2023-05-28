<?php

namespace App\Controllers;

class Subscription extends BaseController
{
    //Everyone can
    public function index()
    {
        //SHOW ALL INFO ABOUT ALL SUBSCRIPTIONS
        $data['title'] = "Cookmaster - Subscription";
        $data['subscriptions'] = callAPI('/subscription/all', 'get');
        //var_dump($data['subscriptions']);
        return view('subscription/index', $data);
    }

    //Manager and Super admin can
    public function create()
    {
        $data['title'] = "Create a new subscription";

        if (!$this->request->is('post')) {
            return view('subscriptions/create', $data);
        } else {
            $values = $this->request->getPost();
            $data['message'] = callAPI('/user/', 'post', $values);
            return redirect()->to('/dashboard/subscriptionManagement')->with('message', $data['message']['message']);
        }
    }

    public function edit($id){

        $data['subscription'] = callAPI('/subscription/'.$id, 'get');
        //TODO: SHOW SIGNUP FORM WITH USER DATA PRE-FILLED
        return view('subscription/index', $data);
    }
    public function delete($id){
        //delete subscriptions from DB:
        echo $id;
        $data['message'] = callAPI('/subscription/'.$id, 'delete');
        return redirect()->to('/dashboard/subscriptionManagement')->with('message', $data['message']['message']);
    }


}
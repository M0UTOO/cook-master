<?php

namespace App\Controllers;

class Subscriptions extends BaseController
{
    //Everyone can
    public function show()
    {
        //SHOW ALL INFO ABOUT ALL SUBSCRIPTIONS
        $data['title'] = "Cookmaster - Subscriptions";
        $data['subscriptions'] = callAPI('/subscription/all', 'get');
        return view('subscriptions/index', $data);
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

        $data['subscription'] = callAPI('/user/'.$id, 'get');
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
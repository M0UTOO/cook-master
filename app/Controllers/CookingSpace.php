<?php

namespace App\Controllers;

class CookingSpace extends BaseController
{
    //Everyone can
    public function index()
    {
        //SHOW ALL INFO ABOUT ALL SUBSCRIPTIONS
        $data['title'] = "Cookmaster - Subscription";
        $data['subscriptions'] = callAPI('/subscription/all', 'get');
        return view('subscription/index', $data);
    }

    //Manager can
    public function create()
    {
        //todo: pull api and check This WITH DELETE() TOO
        helper('filesystem');

        $data['title'] = "Create a new subscription";

        if (!$this->request->is('post')) {
            return view('subscription/form', $data);
        } else {
            $values = $this->request->getPost();

            $values['price'] = (float)$values['price'];
            $values['maxlessonaccess'] = (int)$values['maxlessonaccess'];

            $picture = $this->request->getFile('picture');

            $data['message'] = callAPI('/subscription/', 'post', $values);
            $subscriptionID = $data['message']['id'];

            $picture = "img-subscription-".$subscriptionID.".". $picture->getExtension(); //check extension

            $data['state'] = callAPI('/subscription/'.$subscriptionID, 'patch', ['picture' => $picture]);

            if (!$data['state']['error']){
                $picture->move('./assets/images/subscriptions/', 'img-subscription-'.$subscriptionID.'.'.$picture->getExtension());
            }

            return redirect()->to('/subscriptions')->with('message', $data['message']['message']);
        }
    }

    public function edit($id){

        $data['title'] = "Edit the subscription";
        $data['subscription'] = callAPI('/subscription/'.$id, 'get'); //TO DISPLAY THE CURRENT VALUES IN THE FORM

        if (!$this->request->is('post')) {
            return view('subscription/form', $data);
        } else {
            $values = $this->request->getPost();
            $data['message'] = callAPI('/subscription/'.$id, 'patch', $values);
            return redirect()->to('/subscription/'.$id)->with('message', $data['message']['message']);
        }
    }
    public function delete($id){
        helper('filesystem');

        $data['message'] = callAPI('/subscription/'.$id, 'delete');

        if (!$data['message']['error']){
            delete_files('./assets/images/subscriptions/img-subscription-'.$id, true);
        }

        return redirect()->to('/subscriptions')->with('message', $data['message']['message']);
    }

    public function show($id){
        $data['title'] = "Subscription";
        $data['subscription'] = callAPI('/subscription/'.$id, 'get');
        return view('subscription/show', $data);
    }

}
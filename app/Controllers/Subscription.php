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
        return view('subscription/index', $data);
    }

    //Manager can
    public function create()
    {
        //todo: pull api and check This WITH DELETE() TOO
        helper('filesystem');

        $data['title'] = "Create a new subscription";

        if (!$this->request->is('post')) {
            return view('subscription/create', $data);
        } else {
            $values = $this->request->getPost();

            $values['price'] = (float)$values['price'];
            $values['maxlessonaccess'] = (int)$values['maxlessonaccess'];

            $picture = $this->request->getFile('picture');

            $data['message'] = callAPI('/subscription/', 'post', $values);
            if (isset($data['message']['id'])){
                $subscriptionID = $data['message']['id'];

                $picture_name = "img-subscription-".$subscriptionID.".". $picture->getExtension(); //check extension

                $data['state'] = callAPI('/subscription/'.$subscriptionID, 'patch', ['picture' => $picture_name]);

                if (!$data['state']['error']){
                    $directory = './assets/images/subscriptions';
                    if (!file_exists($directory)){
                        mkdir($directory, 755, true);
                        chmod($directory, 755);
                    }
                    $picture->move($directory, $picture_name);
                }
            }

            return redirect()->to('/subscriptions')->with('message', $data['message']['message']);
        }
    }

    public function edit($id){

        $data['title'] = "Edit the subscription";
        $data['subscription'] = callAPI('/subscription/'.$id, 'get'); //TO DISPLAY THE CURRENT VALUES IN THE FORM

        if (!$this->request->is('post')) {
            return view('subscription/edit', $data);
        } else {
            $values = $this->request->getPost();
            $values['price'] = (float)$values['price'];
            $values['maxlessonaccess'] = (int)$values['maxlessonaccess'];

            $picture = $this->request->getFile('picture');
            $picture_name = "img-subscription-".$id.".". $picture->getExtension(); //check extension
            $values["picture"] = $picture_name;

            $data['message'] = callAPI('/subscription/'.$id, 'patch', $values);

            if (!$data['message']['error']){
                $directory = './assets/images/subscriptions';
                if (!file_exists($directory)){
                    mkdir($directory, 755, true);
                    chmod($directory, 770);
                }
                $picture->move('./assets/images/subscriptions/', $picture_name, true);
                chmod($directory, 770);
            }

            return redirect()->to('/subscription/'.$id)->with('message', $data['message']['message']);
        }
    }
    public function delete($id){
        helper('filesystem');

        $data['message'] = callAPI('/subscription/'.$id, 'delete');

        if (!$data['message']['error']){
            echo 'deleted';
            //TODO: delete the picture FROM SERVER
            delete_files('./assets/images/subscriptions/img-subscription-'.$id.".png", true);
            delete_files('./assets/images/subscriptions/img-subscription-'.$id.".jpeg", true);
        }

        return redirect()->to('/subscriptions')->with('message', $data['message']['message']);
    }

    public function show($id){
        $data['title'] = "Subscription";
        $data['subscription'] = callAPI('/subscription/'.$id, 'get');
        return view('subscription/show', $data);
    }

    public function getPayementStatus(){
        $data['title'] = "Confirm and pay your subscription";

    }

}
<?php

namespace App\Controllers;

class CookingSpace extends BaseController
{
    //Everyone can
    public function index()
    {
        //SHOW ALL INFO ABOUT ALL SUBSCRIPTIONS
        $data['title'] = "Cookmaster - Cooking spaces";
        $data['cookingSpace'] = callAPI('/cookingSpace/all', 'get');
        return view('cookingSpace/index', $data);
    }

    //Manager can
    public function create()
    {
        helper('filesystem');

        $data['title'] = "Create a new cookingSpace";

        if (!$this->request->is('post')) {
            return view('cookingSpace/form', $data);
        } else {
            $values = $this->request->getPost();

            $values['price'] = (float)$values['price'];
            $values['maxlessonaccess'] = (int)$values['maxlessonaccess'];

            $picture = $this->request->getFile('picture');

            $data['message'] = callAPI('/cookingSpace/', 'post', $values);
            $cookingSpaceID = $data['message']['id'];

            $picture = "img-cookingSpace-".$cookingSpaceID.".". $picture->getExtension(); //check extension

            $data['state'] = callAPI('/cookingSpace/'.$cookingSpaceID, 'patch', ['picture' => $picture]);

            if (!$data['state']['error']){
                $picture->move('./assets/images/cookingSpace/', 'img-cookingSpace-'.$cookingSpaceID.'.'.$picture->getExtension());
            }

            return redirect()->to('/cookingSpace')->with('message', $data['message']['message']);
        }
    }

    public function edit($id){

        $data['title'] = "Edit the cooking space";
        $data['cookingSpace'] = callAPI('/cookingSpace/'.$id, 'get'); //TO DISPLAY THE CURRENT VALUES IN THE FORM

        if (!$this->request->is('post')) {
            return view('cookingSpace/form', $data);
        } else {
            $values = $this->request->getPost();
            $data['message'] = callAPI('/cookingSpace/'.$id, 'patch', $values);
            return redirect()->to('/cookingSpace/'.$id)->with('message', $data['message']['message']);
        }
    }
    public function delete($id){
        helper('filesystem');

        $data['message'] = callAPI('/cookingSpace/'.$id, 'delete');

        if (!$data['message']['error']){
            delete_files('./assets/images/cookingSpace/img-cookingSpace-'.$id, true);
        }

        return redirect()->to('/cookingSpace')->with('message', $data['message']['message']);
    }

    public function show($id){
        $data['title'] = "Cooking spaces";
        $data['cookingSpace'] = callAPI('/cookingSpace/'.$id, 'get');
        return view('cookingSpace/show', $data);
    }

}
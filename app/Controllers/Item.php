<?php

namespace App\Controllers;

class Item extends BaseController
{
    public function index()
    {
        $data['title'] = lang('Common.itemCookMaster');
        if (isManager()){
            //SHOW ALL INFO ABOUT ALL ITEMS
            $data['items'] = callAPI('/cookingitem/all', 'get');
            return view('item/index', $data);
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : '. $data['title']);
        }
    }

    public function addCookingSpace($id)
    {
        if (isManager()) {

            if (!$this->request->is('post')) {
                $data['title'] = lang('Common.itemAddCookingSpace');
                $data['iditem'] = $id;
                $data['cookingspaces'] = callAPI('/cookingspace/all', 'get');
                return view('item/cookingspace', $data);
            } else {
                $values = $this->request->getPost();

                $data['message'] = callAPI('/cookingitem/' . $id, 'patch', ['idcookingspace' => (int)$values['idcookingspace']]);
                return redirect()->to('/items')->with('message', $data['message']['message']);
            }
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : ');
        }
    }

    public function deleteCookingSpace($id)
    {
        if (isManager()) {

            $data['message'] = callAPI('/cookingitem/' . $id, 'patch', ['idcookingspace' => 1]);
            return redirect()->to('/items')->with('message', $data['message']['message']);

        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : ');
        }
    }

    //Manager can
    public function create()
    {

        $data['title'] = lang('Common.itemCreate');

        if (isManager()){

            if (!$this->request->is('post')) {
                return view('item/create', $data);
            } else {
                $values = $this->request->getPost();

                $values['status'] = "Available";

                $values['idcookingspace'] = 1;

                $data['message'] = callAPI('/cookingitem/', 'post', $values);

                return redirect()->to('/items')->with('message', $data['message']['message']);
            }
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : '. $data['title']);
        }
    }

    public function update($id)
    {
        if (isManager()) {

            $data['message'] = callAPI('/cookingitem/' . $id, 'get');

            if ($data['message']['status'] == "Available") {
                $data['message'] = callAPI('/cookingitem/' . $id, 'patch', ['status' => "Unavailable"]);
            } else {
                $data['message'] = callAPI('/cookingitem/' . $id, 'patch', ['status' => "Available"]);
            }

            return redirect()->to('/items')->with('message', $data['message']['message']);

        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : '. $data['title']);
        }
    }

    public function delete($id)
    {

        if (isManager()) {

            $data['message'] = callAPI('/cookingitem/' . $id, 'delete');
            return redirect()->to('/items')->with('message', $data['message']['message']);

        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : ');
        }
    }

}
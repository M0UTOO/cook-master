<?php

namespace App\Controllers;

class Ingredient extends BaseController
{
    public function index()
    {
        $data['title'] = lang('Common.ingredientCookMaster');
        if (isManager()){
            //SHOW ALL INFO ABOUT ALL INGREDIENTS
            $data['ingredients'] = callAPI('/ingredient/all', 'get');
            return view('ingredient/index', $data);
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : '. $data['title']);
        }
    }
    
    public function addCookingSpace($id)
    {
        if (isManager()) {

            if (!$this->request->is('post')) {
                $data['title'] = lang('Common.ingredientAddCookingSpace');
                $data['idingredient'] = $id;
                $data['cookingspaces'] = callAPI('/cookingspace/all', 'get');
                return view('ingredient/cookingspace', $data);
            } else {
                $values = $this->request->getPost();

                $data['message'] = callAPI('/ingredient/' . $id, 'patch', ['idcookingspace' => (int)$values['idcookingspace']]);
                return redirect()->to('/ingredients')->with('message', $data['message']['message']);
            }
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : ');
        }
    }

    public function deleteCookingSpace($id)
    {
        if (isManager()) {

            $data['message'] = callAPI('/ingredient/' . $id, 'patch', ['idcookingspace' => 1]);
            return redirect()->to('/ingredients')->with('message', $data['message']['message']);

        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : ');
        }
    }

    //Manager can
    public function create()
    {

        $data['title'] = lang('Common.ingredientCreate');

        if (isManager()){

            if (!$this->request->is('post')) {
                return view('ingredient/create', $data);
            } else {
                $values = $this->request->getPost();

                if ($values['allergen'] == "") {
                    $values['allergen'] = "None";
                } 

                $values['idcookingspace'] = 1;

                $data['message'] = callAPI('/ingredient/', 'post', $values);

                return redirect()->to('/ingredients')->with('message', $data['message']['message']);
            }
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : '. $data['title']);
        }
    }

    public function delete($id)
    {
        if (isManager()) {

            $data['message'] = callAPI('/ingredient/' . $id, 'delete');
            return redirect()->to('/ingredients')->with('message', $data['message']['message']);

        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : ');
        }
    }

}
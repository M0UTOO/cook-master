<?php

namespace App\Controllers;

class Premise extends BaseController
{
    public function index()
    {
        //SHOW ALL INFO ABOUT ALL PREMISE
        $data['title'] = "Cookmaster - Premises";
        $data['premises'] = callAPI('/premise/all', 'get');
       // var_dump($data['premises']);
        return view('premises/index', $data);
    }

    //Manager can
    public function create()
    {

        $data['title'] = "Create a new premise";

        if (!$this->request->is('post')) {
            return view('premises/create', $data);
        } else {
            $values = $this->request->getPost();

            $values['streetnumber'] = $values['streetnumber'];

            $data['message'] = callAPI('/premise/', 'post', $values);

            return redirect()->to('/premises')->with('message', $data['message']['message']);
        }
    }

    public function edit($id)
    {

        $data['title'] = "Edit the premise";
        $data['premise'] = callAPI('/premise/' . $id, 'get'); //TO DISPLAY THE CURRENT VALUES IN THE FORM

        if (!$this->request->is('post')) {
            return view('premises/edit', $data);
        } else {
            $values = $this->request->getPost();
            $values['streetnumber'] = $values['streetnumber'];

            $data['message'] = callAPI('/premise/' . $id, 'patch', $values);

            return redirect()->to('/premise/edit/' . $id)->with('message', $data['message']['message']);
        }
    }

    public function delete($id)
    {

        $data['message'] = callAPI('/premise/' . $id, 'delete');

        return redirect()->to('/premises')->with('message', $data['message']['message']);
    }

    public function show($id)
    {
        //SHOW INFO OF A PREMISE AND LIST COOKING SPACES IN SAID PREMISE

        $data['premise'] = callAPI('/premise/' . $id, 'get');
        $data['cookingSpaces'] = callAPI('/cookingspace/premise/' . $id, 'get');
        $data['title'] = "Premise - " . $data['premise']['name'];
        return view('premises/show', $data);
    }


}
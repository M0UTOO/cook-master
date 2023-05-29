<?php

namespace App\Controllers;

class ContractorType extends BaseController
{
    private $contractorTypes;
    public function __construct()
    {
        helper('curl_helper');
        $this->contractorTypes = $this->getContractorTypes();
    }

    public function index()
    {
        $data['title'] = "All contractor types";
        $data['contractorTypes'] = callAPI('/contractor/type', 'get');

        return view('contractorType/index', $data);
    }

    //Manager can
    public function create()
    {
        $data['title'] = "Create a new contractor type";

        if (!$this->request->is('post')) {
            return view('contractorType/form', $data);
        } else {
            $values = $this->request->getPost();

            $data['message'] = callAPI('/contractor/type', 'post', $values);

            return redirect()->to('/contractorTypes')->with('message', $data['message']['message']);
        }
    }

    public function delete($id){
        helper('filesystem');

        $data['message'] = callAPI('/contractor/type/'.$id, 'delete');

        return redirect()->to('/contractorTypes')->with('message', $data['message']['message']);
    }

    public function getContractorTypes()
    {
        $response = callAPI('/contractor/type', 'get');

        return $response;
    }

}
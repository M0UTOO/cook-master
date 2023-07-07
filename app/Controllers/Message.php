<?php

namespace App\Controllers;

class Message extends BaseController
{
    public function index() {

        $data['title'] = lang('Common.title_message');
        $data['iduser'] = getCurrentUserId();
        $data['roles'] = callAPI('/contractor/role/chief', 'get');

        return view('message/index', $data);
    }


    public function show($idcontractor) {

        $data['iduser'] = getCurrentUserId();
        $data['contractor'] = callAPI('/contractor/'.$idcontractor, 'get');
        $data['title'] = $data['contractor']['firstname'] . ' ' . $data['contractor']['lastname'];
        $data['messages'] = callAPI('/message/'.$idcontractor .'/' . $data['iduser'], 'get');
        $data['idcontractor'] = $idcontractor;

        return view('message/show', $data);
    }
}
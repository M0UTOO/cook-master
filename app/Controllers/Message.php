<?php

namespace App\Controllers;

class Message extends BaseController
{
    public function index() {

        $data['iduser'] = getCurrentUserId();
        if (isClient()) {
            $data['title'] = lang('Common.title_message_chief');
            $data['roles'] = callAPI('/contractor/role/chief', 'get');
            $values['subscription'] = getSubscription();
            if (isset($data['subscription']['allowchat'])) {
                $data['subscription']['allowchat'] = (bool)$data['subscription']['allowchat'];
            }
            if (isset($values['subscription']) && isset($values['subscription']['allowchat']) && !$values['subscription']['allowchat']) {
                return redirect()->to('/subscriptions')->with('message', lang('Common.mustHaveSubscription'));
            }
        } else if (isContractor()) {
            $data['title'] = lang('Common.title_message_contractor');
            $data['managers'] = callAPI('/manager/all', 'get');
            $data['clients'] = callAPI('/message/chief/' . $data['iduser'], 'get');
            if (isset($data['clients']) && (isset($data['clients']['error']))) {
                $data['title'] = lang('Common.title_message_manager');
                unset($data['clients']);
            }
        } else {
            $data['title'] = lang('Common.title_message_client');
            $data['roles'] = callAPI('/contractor/all', 'get');
        }

        return view('message/index', $data);
    }


    public function show($id) {

        if (isClient() || isManager()) {
            $data['iduser'] = getCurrentUserId();
            $data['contractor'] = callAPI('/contractor/'.$id, 'get');
            if (isset($data['contractor']['error'])) {
                $data['contractor'] = callAPI('/manager/'.$id, 'get');
            }
            $data['title'] = $data['contractor']['firstname'] . ' ' . $data['contractor']['lastname'];
            $data['messages'] = callAPI('/message/'.$id .'/' . $data['iduser'], 'get');
            $data['idcontractor'] = $id;
        } else if (isContractor()) {
            $data['iduser'] = getCurrentUserId();
            $data['contractor'] = callAPI('/client/'.$id, 'get');
            if (isset($data['contractor']['error'])) {
                $data['contractor'] = callAPI('/manager/'.$id, 'get');
            }
            $data['title'] = $data['contractor']['firstname'] . ' ' . $data['contractor']['lastname'];
            $data['messages'] = callAPI('/message/'.$id .'/' . $data['iduser'], 'get');
            $data['idclient'] = $id;
        } else {
            return redirect()->to('/signIn')->with('message', lang('Common.mustBeLoggedIn'));
        }

        return view('message/show', $data);
    }
}
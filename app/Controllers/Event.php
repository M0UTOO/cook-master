<?php

namespace App\Controllers;

class Event extends BaseController
{
    public function index() {
        helper('pagination');

        if($this->request->is('post')) {
            $values = $this->request->getPost();
            $values['search'] = str_replace(' ', '%20', $values['search']);
            if (empty($values['search'])){
                return redirect()->to('/events')->with('message', 'Please enter a valid search');
            }
            $data['title'] = lang('Common.eventsTitle');
            $data['events'] = callAPI('/event/search/' . $values['search'] . '', 'post', $this->request->getPost());
            $data['search'] = $values['search'];
            return view('event/index', $data);
        }

        $data['title'] = lang('Common.eventsTitle');
        $events['events'] = callAPI('/event/all', 'get');
        
        $events['pagination'] = pagination($events['events']);
        $data['events'] = $events['pagination']['display'];
        $data['totalPages'] = $events['pagination']['totalPages'];
    
        return view('event/index', $data);
    }


    public function create()
    {
        helper('filesystem');

        $data['title'] = lang('Common.create_events');;

        if (!$this->request->is('post')) {
            return view('event/create', $data);
        }
        else
        {
            $values = $this->request->getPost();
            if (isset($values['isinternal'])) {
                $values['isinternal'] = boolval($values['isinternal']);
            }
            if (isset($values['isprivate'])) {
                $values['isprivate'] = boolval($values['isprivate']);
            }
            if (isset($values['defaultpicture'])) {
                $values['defaultpicture'] = $values['defaultpicture'] = $this->request->getFile('defaultpicture');
            }
            if (isset($values['endtime'])) {
                $values['endtime'] = date("Y-m-d H:i:s", strtotime($values['endtime']));
            }
            if (isset($values['starttime'])) {
                $values['starttime'] = date("Y-m-d H:i:s", strtotime($values['starttime']));
            }

            $userId = $values['user_id'];
            unset($values['user_id']);

            $picture = $this->request->getFile('defaultpicture');

            $data['message'] = callAPI('/event/'.$userId, 'post', $values);
            if (isset($data['message']['id'])) {
                $eventID = $data['message']['id'];

                $picture_name = "img-event-".$eventID.".". $picture->getExtension(); //check extension

                $data['state'] = callAPI('/event/'.$eventID, 'patch', ['defaultpicture' => $picture_name]);
                if (!$data['state']['error']){
                    $directory = './assets/images/events';
                    if (!file_exists($directory)){
                        mkdir($directory, 755, true);
                        chmod($directory, 755);
                    }
                    $picture->move($directory, $picture_name);
                }
            }
            return redirect()->to('/events')->with('message', $data['message']['message']);
        }
    }
    
    public function show($id){

        $currentUser['id'] = session()->get('id');
        $currentUser['role'] = session()->get('role');
        $currentUser['subscription'] = session()->get('subscription');
        $data['event'] = callAPI('/event/'.$id, 'get');
        $data['rate'] = callAPI('/event/rate/'.$id, 'get');
        $data['animate'] = callAPI('/event/animate/'.$id, 'get');
        $data['participation'] = callAPI('/event/participate/' . $data['event']['idevent'], 'get');
        $data['comments'] = callAPI('/event/comment/' . $data['event']['idevent'], 'get');
        $data['space'] = callAPI('/event/host/' . $data['event']['idevent'], 'get');
        if ($data['event']['ideventgroups'] != 1) {
            $data['eventGroup'] = callAPI('/event/group/' . $data['event']['ideventgroups'], 'get');
            $data['group'] = callAPI('/event/groups/' . $data['event']['idevent'], 'get');
        }
        if ($data['event']['isprivate'] == true) {
            if ($data['participation'] != null ) {
                $currentId = getCurrentUserId();
                $verif = false;
                foreach ($data['participation'] as $client) {
                    if ($client->iduser == $currentId) {
                        $verif = true;
                    }
                }
                if ($currentUser['role'] != 'manager' && $currentUser['role'] != 'contractor' && !$verif) {
                    return redirect()->to('/events')->with('message', "Event already joined.");
                }
            }
        }
        
        return view('event/show', $data);
    }

    public function join() {
        $values = $this->request->getPost();
        $data['message'] = callAPI('/event/participate/' . $values['idevent'] . '/' . $values['iduser'] . '', 'post');
        return redirect()->to('/event/' . $values['idevent'] . '')->with('message', $data['message']['message']);
    }

    public function leave() {
        $values = $this->request->getPost();
        $data['message'] = callAPI('/event/participate/' . $values['idevent'] . '/' . $values['iduser'] . '', 'delete');
        return redirect()->to('/event/' . $values['idevent'] . '')->with('message', $data['message']['message']);
    }

    public function edit($id){

        helper('filesystem');

        $currentUser['id'] = session()->get('id');
        $currentUser['role'] = session()->get('role');

        $data['title'] = "Edit the lesson";
        $data['event'] = callAPI('/event/'.$id, 'get');
        $data['animate'] = callAPI('/event/animate/'.$id, 'get');

        if ($currentUser['role'] != 'manager') {
            if ($currentUser['id'] != $data['event']['iduser']) {
                return redirect()->to('/event/' . $id . '')->with('message', 'You are not allowed to edit this event');
            }
        }

        if (!$this->request->is('post')) {
            return view('event/edit', $data);
        }
        else
        {
            $values = $this->request->getPost();
            if (isset($values['isinternal'])) {
                $values['isinternal'] = (int)($values['isinternal']);
            }
            if (isset($values['isprivate'])) {
                $values['isprivate'] = (int)($values['isprivate']);
            }
            if (isset($values['defaultpicture'])) {
                $values['defaultpicture'] = $values['defaultpicture'] = $this->request->getFile('defaultpicture');
            }
            if (isset($values['endtime'])) {
                $values['endtime'] = date("Y-m-d H:i:s", strtotime($values['endtime']));
            }
            if (isset($values['starttime'])) {
                $values['starttime'] = date("Y-m-d H:i:s", strtotime($values['starttime']));
            }

            $userId = $values['user_id'];
            unset($values['user_id']);

            if (isset($values['defaultpicture'])) {
                $picture = $this->request->getFile('defaultpicture');
            }

            $data['message'] = callAPI('/event/'.$id, 'patch', $values);
            if (isset($values['defaultpicture'])) {
                if (isset($data['message']['message']) && $data['message']['message'] == "event updated") {
                    $eventID = $id;

                    $picture_name = "img-event-".$eventID.".". $picture->getExtension(); //check extension

                    $data['state'] = callAPI('/event/'.$eventID, 'patch', ['defaultpicture' => $picture_name]);
                    if (!$data['state']['error']){
                        $directory = './assets/images/events';
                        if (!file_exists($directory)){
                            mkdir($directory, 755, true);
                            chmod($directory, 755);
                        }
                        if (file_exists($directory . '/' . $picture_name)){
                            unlink($directory . '/' . $picture_name);
                        }
                        $picture->move($directory, $picture_name);
                    }
                }
            }
            return redirect()->to('/event/'.$id)->with('message', $data['message']['message']);
        }
    }

    public function delete($id){

        helper('filesystem');

        $verif['message'] = callAPI('/event/'.$id, 'get');
        $data['animate'] = callAPI('/event/animate/'.$id, 'get');

        if ($data['animate'][0]->iduser != session()->get('id') && session()->get('role') != "manager"){
            return redirect()->to('/lessons')->with('message', "You can't delete this lesson");
        }

        $data['message'] = callAPI('/event/'.$id, 'delete');

        if ($data['message']['error'] == false){
            delete_files('./assets/images/events/img-lesson-'.$id, true);
        }

        return redirect()->to('/events')->with('message', $data['message']['message']);
    }

    public function group() {
        $data['title'] = "Add an event to a group";
        $data['events'] = callAPI('/event/all', 'get');
        $data['groups'] = callAPI('/eventGroup/all', 'get');
        return view('event/group', $data);
    }

    public function getAllEvents() {
        return callAPI('/event/all', 'get');
    }

    public function close($id) {
        $data['animate'] = callAPI('/event/animate/'.$id, 'get');
        $currentId = getCurrentUserId();
        $verifContractor = false;
        foreach ($data['animate'] as $contractor) {
            if ($contractor->iduser == $currentId) {
                $verifContractor = true;
            }
        }
        if (isManager() || $verifContractor) {
            $data['message'] = callAPI('/event/'.$id, 'patch', ['isclosed' => 1]);
            return redirect()->to('/eventContractor/index/' . $currentId)->with('message', $data['message']['message']);
        } else {
            return redirect()->to('/eventContractor/index/' . $currentId)->with('message', "You are not allowed to access this page.");
        }
    }
}
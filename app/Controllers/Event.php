<?php

namespace App\Controllers;

class Event extends BaseController
{
    public function index() {
        helper('pagination');

        if($this->request->is('post')) {
            $values = $this->request->getPost();
            $values['search'] = str_replace(' ', '%20', $values['search']);
            $data['title'] = "Join the cooking course of your dreams";
            $data['events'] = callAPI('/event/search/' . $values['search'] . '', 'post', $this->request->getPost());
            $data['search'] = $values['search'];
            return view('event/index', $data);
        }

        $data['title'] = "Join the cooking course of your dreams";
        $events['events'] = callAPI('/event/all', 'get');
        
        $events['pagination'] = pagination($events['events']);
        $data['events'] = $events['pagination']['display'];
        $data['totalPages'] = $events['pagination']['totalPages'];
    
        return view('event/index', $data);
    }


    public function create()
    {
        helper('filesystem');

        $data['title'] = "Create a new event";

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

            $data['message'] = callAPI('/event/'.$userId, 'post', $values);

            /*$lessonID = $data['message']['id'];

            $picture = "img-lesson-".$lessonID.".". $picture->getExtension(); //check extension

            $data['state'] = callAPI('/lesson/'.$lessonID, 'patch', ['picture' => $picture]);

            if (!$data['state']['error']){
                $picture->move('./assets/images/lessons/', 'img-lesson-'.$lessonID.'.'.$picture->getExtension());
            }*/

            return redirect()->to('/events')->with('message', $data['message']['message']);
        }
    }
    
    public function show($id){

        $currentUser['id'] = session()->get('id');
        $currentUser['role'] = session()->get('role');
        $currentUser['subscription'] = session()->get('subscription');
        $data['event'] = callAPI('/event/'.$id, 'get');
        $data['rate'] = callAPI('/event/rate/'.$id, 'get');
        $data['participation'] = callAPI('/event/participate/' . $data['event']['idevent'], 'get');
        $data['comments'] = callAPI('/event/comment/' . $data['event']['idevent'], 'get');
        if ($data['event']['isprivate'] == true) {
            if ($participation != null) {
                return redirect()->to('/events')->with('message', "Event already joined.");
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
}
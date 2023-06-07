<?php

namespace App\Controllers;

class Event extends BaseController
{
    public function index(){

        $data['title'] = "Cookmaster - Events";
        $data['events'] = callAPI('/event/all', 'get');
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
}
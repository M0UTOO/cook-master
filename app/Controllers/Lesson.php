<?php

namespace App\Controllers;

class Lesson extends BaseController
{
    //Everyone can
    public function index()
    {
        //SHOW ALL INFO ABOUT ALL LESSONS
        $data['title'] = "Cookmaster - Lessons";
        $data['lessons'] = callAPI('/lesson/all', 'get');
        return view('lesson/index', $data);
    }

    //Manager can
    public function create()
    {
        helper('filesystem');

        $data['title'] = "Create a new lesson";

        if (!$this->request->is('post')) {
            return view('lesson/form', $data);
        } else {
            $values = $this->request->getPost();

            $values['price'] = (float)$values['price'];
            $values['maxlessonaccess'] = (int)$values['maxlessonaccess'];

            $picture = $this->request->getFile('picture');

            $data['message'] = callAPI('/lesson/', 'post', $values);
            $lessonID = $data['message']['id'];

            $picture = "img-lesson-".$lessonID.".". $picture->getExtension(); //check extension

            $data['state'] = callAPI('/lesson/'.$lessonID, 'patch', ['picture' => $picture]);

            if (!$data['state']['error']){
                $picture->move('./assets/images/lessons/', 'img-lesson-'.$lessonID.'.'.$picture->getExtension());
            }

            return redirect()->to('/lessons')->with('message', $data['message']['message']);
        }
    }

    public function edit($id){

        $data['title'] = "Edit the lesson";
        $data['lesson'] = callAPI('/lesson/'.$id, 'get'); //TO DISPLAY THE CURRENT VALUES IN THE FORM

        if (!$this->request->is('post')) {
            return view('lesson/form', $data);
        } else {
            $values = $this->request->getPost();
            $data['message'] = callAPI('/lesson/'.$id, 'patch', $values);
            return redirect()->to('/lesson/'.$id)->with('message', $data['message']['message']);
        }
    }
    public function delete($id){
        helper('filesystem');

        $data['message'] = callAPI('/lesson/'.$id, 'delete');

        if (!$data['message']['error']){
            delete_files('./assets/images/lessons/img-lesson-'.$id, true);
        }

        return redirect()->to('/lessons')->with('message', $data['message']['message']);
    }

    public function show($id){
        $data['title'] = "Lesson";
        $data['lesson'] = callAPI('/lesson/'.$id, 'get');
        return view('lesson/show', $data);
    }

}
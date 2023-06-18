<?php

namespace App\Controllers;

class Lesson extends BaseController
{
    private array $lessons;
    public function __construct()
    {   helper('curl_helper');
        $this->lessons = $this->getAllLessons();
    }

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
            return view('lesson/create', $data);
        } else {
            $values = $this->request->getPost();

            $values['difficulty'] = (int)$values['difficulty'];

            /*$content = $this->request->getFile('content');

            $values['content'] = $content;*/

            $userId = $values['user_id'];
            unset($values['user_id']);

            $data['message'] = callAPI('/lesson/'.$userId, 'post', $values);

            /*$lessonID = $data['message']['id'];

            $picture = "img-lesson-".$lessonID.".". $picture->getExtension(); //check extension

            $data['state'] = callAPI('/lesson/'.$lessonID, 'patch', ['picture' => $picture]);

            if (!$data['state']['error']){
                $picture->move('./assets/images/lessons/', 'img-lesson-'.$lessonID.'.'.$picture->getExtension());
            }*/

            return redirect()->to('/lessons')->with('message', $data['message']['message']);
        }
    }

    public function edit($id){

        $currentUser['id'] = session()->get('id');
        $curentUser['role'] = session()->get('role');

        $data['title'] = "Edit the lesson";
        $data['lesson'] = callAPI('/lesson/'.$id, 'get'); //TO DISPLAY THE CURRENT VALUES IN THE FORM

        //TODO: find lesson author and you can edit lesson only if u are the author or a manager.

        if (!$this->request->is('post')) {
            return view('lesson/edit', $data);
        }
        else
        {
            $values = $this->request->getPost();
            $values['difficulty'] = (int)$values['difficulty'];

            unset($values['user_id']);

            $data['message'] = callAPI('/lesson/'.$id, 'patch', $values);
            return redirect()->to('/lesson/'.$id)->with('message', $data['message']['message']);
        }
    }
    public function delete($id){

        helper('filesystem');

        $verif['message'] = callAPI('/lesson/'.$id, 'get');

        var_dump(session()->get('role'));

        if ($verif['message']['iduser'] != session()->get('id') && session()->get('role') != "manager"){
            return redirect()->to('/lessons')->with('message', "You can't delete this lesson");
        }

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

    public function getAllLessons()
    {
        return callAPI('/lesson/all', 'get');
    }

}
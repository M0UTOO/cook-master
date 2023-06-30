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

            $picture = $this->request->getFile('picture');

            $userId = $values['user_id'];
            unset($values['user_id']);

            $data['message'] = callAPI('/lesson/'.$userId, 'post', $values);
            if (isset($data['message']['id'])) {
                $lessonID = $data['message']['id'];

                $picture_name = "img-lesson-".$lessonID.".". $picture->getExtension(); //check extension

                $data['state'] = callAPI('/lesson/'.$lessonID, 'patch', ['picture' => $picture_name]);

                if (!$data['state']['error']){
                    $directory = './assets/images/lessons';
                    if (!file_exists($directory)){
                        mkdir($directory, 755, true);
                        chmod($directory, 755);
                    }
                    $picture->move($directory, $picture_name);
                }
            }

            return redirect()->to('/lessons')->with('message', $data['message']['message']);
        }
    }

    public function edit($id){

        $currentUser['id'] = session()->get('id');
        $currentUser['role'] = session()->get('role');

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

        $currentUser['id'] = session()->get('id');
        $currentUser['role'] = session()->get('role');
        $currentUser['subscription'] = session()->get('subscription');

        if ($currentUser['role'] == "client"){
            $update['message'] = callAPI('/lesson/views/'.$currentUser['id'], 'delete');
            $update['count'] = callAPI('/lesson/views/'.$currentUser['id'], 'get');
            $update['watched'] = callAPI('/lesson/watch/'.$currentUser['id'].'/'.$id, 'get');
            if ($currentUser['subscription']['name'] != "Master") {
                if ($update['watched']['iswatched'] == false) {
                    if ($currentUser['subscription']['maxlessonaccess'] - $update['count']['count'] <= 0) {
                            return redirect()->to('/lessons')->with('message', "You can't access this lesson, you have reached your limit of lessons a day.");
                
                    } else {
                        $update['message'] = callAPI('/client/watch/'.$currentUser['id'].'/'.$id, 'patch');
                    }
                }
            }
        }

        $data['title'] = "Lesson";
        $data['lesson'] = callAPI('/lesson/'.$id, 'get');
        if ($data['lesson']['idlessongroup'] != 0 || $data['lesson']['idlessongroup'] != 1) {
            $data['lessonGroup'] = callAPI('/lesson/group/'.$data['lesson']['idlessongroup'], 'get');
            $data['others'] = true;
        }
        if ($data['lesson']['idlessongroup'] == 1 || $data['lessonGroup'] == null){
            $data['lessonGroup'] = callAPI('/lesson/suggested', 'get');
            $data['random'] = true;
        }
        
        return view('lesson/show', $data);
    }

    public function getAllLessons()
    {
        return callAPI('/lesson/all', 'get');
    }

}
<?php

namespace App\Controllers;

class LessonGroup extends BaseController
{
    //TODO: CREATE ROUTES IN ROUTES.php
    private $lessonGroups;
    public function __construct()
    {
        helper('curl_helper');
        $this->lessonGroups = $this->getLessonGroupsFromDB();
    }

    public function index()
    {
        $data['title'] = "All lesson groups";
        $data['lessonGroups'] = callAPI('/lesson/group/all', 'get');

        return view('lessonGroup/index', $data);
    }



      public function add()
    {
        $data['title'] = "Add a lesson to a group";

        if (!$this->request->is('post'))
        {
            return view('lessonGroup/add', $data);
        }
        else
        {
            $values = $this->request->getPost();
            if ($values['lesson-group-choice'] == "1"){
                return redirect()->to('/lessons')->with('message', "Can't add to the default group");
            }
            $lessonid = $values['idlesson'];
            unset($values['idlesson']);

            $group['message'] = callAPI('/lesson/group/get/'.$values['lesson-group-choice'], 'get');
            if (isset($group['message']['error'])){
                return redirect()->to('/lessons')->with('message', $group['message']['message']);
            }

            $body = [
                'name' => $group['message']['name'],
                'group_display_order' => (int)$values['group_display_order']
            ];

            $data['message'] = callAPI('/lesson/group/'.$lessonid, 'post', $body);

            return redirect()->to('/lessons')->with('message', $data['message']['message']);
        }
    }

    public function addgroup()
    {
        $data['title'] = "Add a group";

        if (!$this->request->is('post'))
        {
            return view('lessonGroup/addgroup', $data);
        }
        else
        {
            $values = $this->request->getPost();

            $data['message'] = callAPI('/lesson/group/post', 'post', $values);

            return redirect()->to('/lessonGroups')->with('message', $data['message']['message']);
        }
    }

    /*public function create()
    {
        $data['title'] = "Create a new lesson group";

        if (!$this->request->is('post'))
        {
            return view('lessonGroup/create', $data);
        }
        else
        {
            $values = $this->request->getPost();

            $data['message'] = callAPI('/lesson/group', 'post', $values);

            return redirect()->to('/lessonGroups')->with('message', $data['message']['message']);
        }
    }*/

    public function delete($id)
    {
        $data['message'] = callAPI('/lesson/group/delete/'.$id, 'delete');

        return redirect()->to('/lessonGroups')->with('message', $data['message']['message']);
    }

    public function getLessonsByGroup($id)
    {
        $data['title'] = "Lessons by group";
        return $data['lessons'] = callAPI('/lesson/group/'.$id, 'get');
    }

    public function getLessonGroupsFromDB()
    {
        $response = callAPI('/lesson/group/all', 'get');

        return $response;
    }

    public function getLessonGroups()
    {
        return $this->lessonGroups;
    }


}
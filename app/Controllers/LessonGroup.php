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
        $data['title'] = "All contractor types";
        $data['lessonGroups'] = callAPI('/lesson/group', 'get');

        return view('lessonGroups/index', $data);
    }

    //Manager can
    public function create()
    {
        $data['title'] = "Create a new contractor type";

        if (!$this->request->is('post'))
        {
            return view('contractorType/form', $data);
        }
        else
        {
            $values = $this->request->getPost();

            $data['message'] = callAPI('/lesson/group', 'post', $values);

            return redirect()->to('/lessonGroups')->with('message', $data['message']['message']);
        }
    }

    public function delete($id)
    {
        $data['message'] = callAPI('/lesson/group/'.$id, 'delete');

        return redirect()->to('/lessonGroups')->with('message', $data['message']['message']);
    }

    public function getLessonGroupsFromDB()
    {
        $response = callAPI('/lesson/group', 'get');

        return $response;
    }

    public function getLessonGroups()
    {
        return $this->lessonGroups;
    }


}
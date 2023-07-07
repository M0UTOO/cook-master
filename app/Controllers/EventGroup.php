<?php

namespace App\Controllers;

class EventGroup extends BaseController
{
    private $eventGroups;
    public function __construct()
    {
        helper('curl_helper');
        $this->eventGroups = $this->getEventGroupsFromDB();
    }

    public function index()
    {
        $data['title'] = "All event groups";
        $data['eventGroups'] = callAPI('/event/group/all', 'get');

        return view('eventGroup/index', $data);
    }



      public function add()
    {
        $data['title'] = "Add a event to a formation";

        if (!$this->request->is('post'))
        {
            return view('eventGroup/add', $data);
        }
        else
        {
            $values = $this->request->getPost();
            $eventid = $values['idevent'];
            unset($values['idevent']);
            $values['name'] = $values['lesson-group-choice'];
            unset($values['lesson-group-choice']);
            $values['group_display_order'] = (int)$values['group_display_order'];

            $data['message'] = callAPI('/event/group/'.$eventid, 'post', $values);

            return redirect()->to('/events')->with('message', $data['message']['message']);
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
        $data['message'] = callAPI('/event/group/'.$id, 'delete');

        return redirect()->to('/event/' . $id)->with('message', $data['message']['message']);
    }

    public function getEventsByGroup($id)
    {
        $data['title'] = "Events by group";
        return $data['events'] = callAPI('/event/group/'.$id, 'get');
    }

    public function getEventGroupsFromDB()
    {
        $response = callAPI('/event/group/all', 'get');

        return $response;
    }

    public function getEventGroups()
    {
        return $this->eventGroups;
    }


}
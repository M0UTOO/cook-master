<?php

namespace App\Controllers;

class EventSpace extends BaseController
{

      public function addspace()
    {
        $data['title'] = "Add a cooking space to an event";

        if (!$this->request->is('post'))
        {
            return view('eventSpace/add', $data);
        }
        else
        {
            $values = $this->request->getPost();
            $eventid = $values['idevent'];
            unset($values['idevent']);
            $contractorid = $values['idcookingspace'];
            unset($values['idcookingspace']);

            $data['message'] = callAPI('/event/host/'.$eventid . '/' . $contractorid, 'patch');

            return redirect()->to('/events')->with('message', $data['message']['message']);
        }
    }

    public function delete($idevent, $idspace)
    {
        $data['message'] = callAPI('/event/host/'.$idevent . '/' . $idspace, 'delete');

        return redirect()->to('/event/' . $idevent)->with('message', $data['message']['message']);
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

    public function getAllSpace()
    {
        return callAPI('/cookingspace/all', 'get');
    }

}
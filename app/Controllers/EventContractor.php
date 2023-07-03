<?php

namespace App\Controllers;

class EventContractor extends BaseController
{

      public function addcontractor()
    {
        $data['title'] = "Add a contractor to an event";

        if (!$this->request->is('post'))
        {
            return view('eventContractor/add', $data);
        }
        else
        {
            $values = $this->request->getPost();
            $eventid = $values['idevent'];
            unset($values['idevent']);
            $contractorid = $values['idcontractor'];
            unset($values['idcontractor']);

            $data['message'] = callAPI('/event/animate/'.$eventid . '/' . $contractorid, 'get');

            return redirect()->to('/events')->with('message', $data['message']['message']);
        }
    }

    public function delete($idevent, $idcontractor)
    {
        $data['message'] = callAPI('/event/animate/'.$idevent . '/' . $idcontractor, 'delete');

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

    public function getAllContractors()
    {
        return callAPI('/contractor/all', 'get');
    }

}
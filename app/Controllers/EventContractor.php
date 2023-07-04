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

    public function index($id)
    {
        $data['title'] = "My events";
        $data['events'] = callAPI('/event/animate/get/'.$id, 'get');
        $data['idcontractor'] = $id;

        return view('eventContractor/index', $data);
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
        if (isContractor()) {
            $id = getCurrentUserId();
            return callAPI('/contractor/' . $id, 'get');
        } else {
            return callAPI('/contractor/all', 'get');
        }
    }

    public function clientValidation($id)
    {
        $data['title'] = "Validate client participation";
        $data['clients'] = callAPI('/event/participate/'.$id, 'get');
        $data['event'] = callAPI('/event/'.$id, 'get');
        $data['animate'] = callAPI('/event/animate/'.$id, 'get');

        return view('eventContractor/validate', $data);
    }

    public function removeParticipant($idevent, $iduser)
    {
        $data['message'] = callAPI('/event/participation/'.$idevent . '/' . $iduser, 'delete');

        return redirect()->to('/eventContractor/validate/' . $idevent)->with('message', $data['message']['message']);
    }

    public function addParticipant($idevent, $iduser)
    {
        $data['message'] = callAPI('/event/participation/'.$idevent . '/' . $iduser, 'patch');

        return redirect()->to('/eventContractor/validate/' . $idevent)->with('message', $data['message']['message']);
    }

}
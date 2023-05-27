<?php

namespace App\Controllers;

class Contractor extends Users
{


    public function create()
    {
        $data['title'] = "Create an account";
        $data['isManager'] = isManager();
        $data['userType'] = "Contractor";

        if (!$this->request->is('post')) {
        return view('users/signUp', $data);
        }
        else
        {
            $values = $this->request->getPost();
            //TODO: format dates to be compatible with the database (contractors)
            $type = $values['Type'] ;
            unset($values['Type']);

            if ($type == "Manager") {
                if (isset($values['isitemmanager'])) {
                    $values['isitemmanager'] = boolval($values['isitemmanager']);
                }
                if (isset($values['isusermanager'])) {
                    $values['isusermanager'] = boolval($values['isusermanager']);
                }
                if (isset($values['iseventmanager'])) {
                    $values['iseventmanager'] = boolval($values['iseventmanager']);
                }
                if (isset($values['isothermanager'])) {
                    $values['isothermanager'] = boolval($values['isothermanager']);
                }
                if (isset($values['issuperadmin'])) {
                    $values['issuperadmin'] = boolval($values['issuperadmin']);
                }
            }
            elseif ($type == "Contractor")
            {
                if (isset($values['contractstart'], $values['contractend'])) {
                    //String will be converted to DB format whatever the string date format is, thx PHP.
                   $values['contractstart'] = date("Y-m-d", strtotime($values['contractstart']));
                   $values['contractend'] = date("Y-m-d", strtotime($values['contractend']));
                }
            }

            $data['message'] = callAPI('/user/', 'post', $values, ['Type' => $type]);
            //var_dump($data['message']);
            return redirect()->to('/dashboard/userManagement');
        }
    }
}
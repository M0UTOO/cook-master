<?php

namespace App\Controllers;

class Contractor extends Users
{


    public function create()
    {
        $data['title'] = "Create an account";
        $data['isManager'] = isManager();
        $data['userType'] = $this->request->getGet('type');

        if (!$this->request->is('post')) {
        return view('users/signUp', $data);
        }
        else
        {
            $values = $this->request->getPost();

            $type = $values['Type'] ;
            unset($values['Type']);

            if (isset($values['password'])) {
                $password = new Password($values['password']);
                $values['password'] = $password->__toString();
            }

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

            if (!$data['message']['error']){
//                $mail = new SendMail();
//                $state = $mail->sendWelcomeMail($values['email'], $type, $values['firstname']);
            }

            return redirect()->to('/dashboard/userManagement')->with('message', $data['message']['message']);
        }
    }
}
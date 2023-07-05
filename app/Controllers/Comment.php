<?php

namespace App\Controllers;

class Comment extends BaseController
{

    public function create($id) {
        helper('filesystem');
        helper('validfile');

        $data['title'] = "Add a comment to this event";

        if (!$this->request->is('post')) {
            $data['idevent'] = $id;
            return view('comment/create', $data);
        } else {
            $values = $this->request->getPost();

            $values['grade'] = (float)$values['grade'];

            $values['idevent'] = (int)$values['idevent'];

            $picture = $this->request->getFile('picture');

            $values['idclient'] = (int)callAPI('/client/' . $values['user_id'], 'get');

            unset($values['user_id']);

            $data['message'] = callAPI('/comment/', 'post', $values);
            if (isset($data['message']['id'])) {
                if (!isset($picture) || !isValidImageFileName($picture)) {

                    $commentID = $data['message']['id'];

                    $picture_name = "img-comment-".$commentID.".". $picture->getExtension(); //check extension

                    $data['state'] = callAPI('/comment/'.$commentID, 'patch', ['picture' => $picture_name]);

                    if (!$data['state']['error']){
                        $directory = './assets/images/comments';
                        if (!file_exists($directory)){
                            mkdir($directory, 755, true);
                            chmod($directory, 755);
                        }
                        $picture->move($directory, $picture_name);
                    }
                }
            }

            return redirect()->to('/event/' . $values['idevent'] . '')->with('message', $data['message']['message']);
        }
    }

    public function delete($id) {
        helper('filesystem');

        $values['idclient'] = (int)callAPI('/client/' . session()->get('id'), 'get');

        $verif['message'] = callAPI('/comment/'.$id, 'get');

        if ($verif['message']['idclient'] != $values['idclient'] || (!isClient() && !isContractor())){
            return redirect()->to('/lessons')->with('message', "You can't delete this lesson");
        }

        $data['message'] = callAPI('/comment/'.$id, 'delete');

        if (!$data['message']['error']){
            delete_files('./assets/images/comments/img-comment-'.$id, true);
        }

        return redirect()->to('/event/' . $verif['message']['idevent'])->with('message', $data['message']['message']);
    }
}

?>
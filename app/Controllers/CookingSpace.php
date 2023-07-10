<?php

namespace App\Controllers;

class CookingSpace extends BaseController
{
    //Everyone can
    public function index()
    {
        helper('pagination');
        $data['title'] = "Cookmaster - Cooking spaces";

        if($this->request->is('post')) {
            $values = $this->request->getPost();
            $values['search'] = str_replace(' ', '%20', $values['search']);
            if (empty($values['search'])){
                return redirect()->to('/cookingSpace')->with('message', 'Please enter a valid search');
            }
            $data['cookingSpaces'] = callAPI('/cookingspace/search/' . $values['search'], 'get', $this->request->getPost());
            $data['search'] = $values['search'];
            return view('cookingSpace/index', $data);
        }

        $cookingSpaces['cookingSpaces'] = callAPI('/cookingspace/all', 'get');

        $cookingSpaces['pagination'] = pagination($cookingSpaces['cookingSpaces']);
        $data['cookingSpaces'] = $cookingSpaces['pagination']['display'];
        $data['totalPages'] = $cookingSpaces['pagination']['totalPages'];

        return view('cookingSpace/index', $data);
    }

    //Manager can
    public function create()
    {
        $data['title'] = "Create a new cooking space";

        if (isManager()){

            helper('filesystem');

            if (!$this->request->is('post')) {
                return view('cookingSpace/create', $data);
            }
            else
            {
                $values = $this->request->getPost();
                $picture = $this->request->getFile('picture');

                $pictureName = 'img-cookingspace-'.uniqid().'.'.$picture->getExtension(); //TODO: check extension
                $values['priceperhour'] = (float)$values['priceperhour'];
                $values['size'] = (int)$values['size'];
                $values['picture'] = $pictureName;

                $data['message'] = callAPI('/cookingspace/', 'post', $values);

                if (!$data['message']['error']){
                    $directory = './assets/images/cookingSpaces/'.$data['message']['id'] . '/';
                    if (!file_exists($directory)){
                        mkdir($directory, 755, true);
                        chmod($directory, 755);
                    }
                    $picture->move($directory, $pictureName);
                }
                return redirect()->to('/spaces')->with('message', $data['message']['message']);
            }
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : '. $data['title']);
        }
    }

    public function edit($id){

        $data['title'] = "Edit the cooking space";
        if (isManager()){

            $data['cookingSpace'] = callAPI('/cookingspace/'.$id, 'get'); //TO DISPLAY THE CURRENT VALUES IN THE FORM

            $data['reservations'] = callAPI('/cookingspace/books/'.$id, 'get');

            $data['reservations'] = json_decode(json_encode($data['reservations']), true);

            if (!$this->request->is('post')) {
                return view('cookingSpace/edit', $data);
            }
            else
            {
                $values = $this->request->getPost();
                $picture = $this->request->getFile('picture');

                $pictureName = 'img-cookingspace-'.uniqid().'.'.$picture->getExtension(); //TODO: check extension
                $values['priceperhour'] = (float)$values['priceperhour'];
                $values['size'] = (int)$values['size'];
                $values['picture'] = $pictureName;

                if (empty($picture->getName())){
                    unset($values['picture']);
                }

                $data['message'] = callAPI('/cookingspace/'.$id, 'patch', $values);

                if (!$data['message']['error']){
                    $directory = './assets/images/cookingSpaces/'.$data['message']['id'] ;
                    if (file_exists($directory)){
                     $objects = scandir($directory);
                        foreach ($objects as $file){
                            if (is_dir($file)){
                                continue;
                            } else {
                                unlink($directory. DIRECTORY_SEPARATOR.$file);
                            }
                        }
                    } else {
                        mkdir($directory, 755, true);
                        chmod($directory, 755);
                    }
                    $picture->move($directory, $pictureName);
                }
                return redirect()->to('/premises')->with('message', $data['message']['message']);
            }
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page : '. $data['title']);
        }
    }

    public function delete($id){
        helper('filesystem');
        if (isManager()){
            $data['message'] = callAPI('/cookingspace/'.$id, 'delete');

            if (!$data['message']['error']){
                echo 'deleted';
                //TODO: delete the picture FROM SERVER
                delete_files('assets/images/cookingSpaces/'.$data['picture'], true);
            }
            return redirect()->to('/cookingSpace')->with('message', $data['message']['message']);
        } else {
            return redirect()->to('/')->with('message', 'You do not have access to the page');
        }
    }

    public function show($id){
        $data['title'] = "Cookmaster - Cooking space";

        $data['cookingSpace'] = callAPI('/cookingspace/'.$id, 'get');

        $data['events'] = callAPI('/cookingspace/event/'.$id, 'get');
        $data['events'] = json_decode(json_encode($data['events']), true);

        $data['reservations'] = callAPI('/cookingspace/books/'.$id, 'get');
        $data['reservations'] = json_decode(json_encode($data['reservations']), true);

        $data['premise'] = callAPI('/premise/cookingspace/'.$id, 'get');

        $data['items'] = callAPI('/cookingitem/cookingspace/'.$id, 'get');
        $data['items'] = json_decode(json_encode($data['items']), true);

        return view('cookingSpace/show', $data);
    }

}
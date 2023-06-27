<?php

namespace App\Controllers;

class CookingSpace extends BaseController
{
    //Everyone can
    public function index()
    {
        $data['title'] = "Cookmaster - Cooking spaces";

        $data['cookingSpaces'] = callAPI('/cookingspace/all', 'get');
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
//            cookingSpace.PATCH("/books/:idclient/:idcookingspace", cookingspaces.AddABooks(tokenAPI))     // WORKING
//	cookingSpace.GET("/books/all", cookingspaces.GetCookingSpacesBooks(tokenAPI)) // WORKING")
//	cookingSpace.DELETE("/books/:idclient/:idcookingspace", cookingspaces.DeleteABooks(tokenAPI)) // WORKING
//	cookingSpace.GET("/books/:id", cookingspaces.GetBooksByCookingSpaceID(tokenAPI)) // WORKING
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
                //TODO : check if picture is empty and remove from patch array if yes.
                $values['picture'] = $pictureName;

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
            $data['message'] = callAPI('/cookingSpace/'.$id, 'delete');

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
        $data['title'] = "Cooking spaces";
        $data['cookingSpace'] = callAPI('/cookingSpace/'.$id, 'get');
        return view('cookingSpace/show', $data);
    }

}
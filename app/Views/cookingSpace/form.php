<?php
helper('form');
helper('url');

    $hidden_input = [];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    if ($url == "cookingSpace/edit/") {
        $action = "cookingSpace/edit/".$cookingSpace['idCookingSpace'];
    } else {
        $action = "cookingSpace/create";
    }

    echo form_open_multipart($action, 'id="cookingSpace-create-form" class="cookingSpace-card"', $hidden_input);

                $value = (isset($cookingSpace) ? $cookingSpace['picture'] :'');
                if ($value)
                {
                    echo '<img class="mb-3 img-fluid img-thumbnail"  alt="can\'t load picture" src="' . base_url("assets/images/cookingSpaces/" . $cookingSpace['idCookingSpace'] . "/". $value) . '" />';
                }

                echo '<div class="form-group mb-3">';
                            echo form_label('Cooking space name' , "label-cookingSpace-name");
                            $value = (isset($cookingSpace) ? $cookingSpace['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Name of cookingSpace", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('Room capacity' , "label-cookingSpace-size");
                $value = (isset($cookingSpace) ? $cookingSpace['size'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'size', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Capacity of the cookingSpace", 'required' => 'required']);
                echo '</div>';


                echo '<div class="form-group mb-3">';
                    echo form_label('Cooking space price' , "label-cookingSpace-city");
                    $value = (isset($cookingSpace) ? $cookingSpace['pricePerHour'] :'');
                    echo form_input(['type'  => 'numeric', 'name'  => 'priceperhour', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Price per hour (€/$)", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('Cooking space picture' , "label-cookingSpace-picture");
                echo form_input(['type'  => 'file', 'name'  => 'picture', 'class' => 'form-control']);
                echo '</div>';
/*
                echo '<div class="form-group mb-3">';
                    echo form_label('Premise country' , "label-cookingSpace-country");
                    $value = (isset($cookingSpace) ? $cookingSpace['country'] :'');
                    echo form_input(['type'  => 'text', 'name'  => 'country', 'class' => 'form-control','placeholder' => "Country",'value' => $value, 'required' => 'required']);
                echo '</div>';*/

                echo '<div class="form-group mb-3">';
                    echo form_submit('', 'Save', 'class="blue-btn btn mt-3 form-control"');
                echo '</div>';
    echo form_close();
?>
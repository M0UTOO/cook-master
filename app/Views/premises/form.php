<?php
helper('form');
helper('url');

    $hidden_input = [];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    if ($url == "premise/edit/") {
        $action = "premise/edit/".$premise['idPremise'];
    } else {
        $action = "premise/create";
    }

    echo form_open_multipart($action, 'id="premise-create-form" class="premise-card"', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label('Premise name' , "label-premise-name");
                            $value = (isset($premise) ? $premise['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Name of premise", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('Premise street number' , "label-premise-street-number");
                $value = (isset($premise) ? $premise['streetNumber'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'streetnumber', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Street number of premise", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label('Premise street name' , "label-premise-street-name");
                    $value = (isset($premise) ? $premise['streetName'] :'');
                    echo form_input(['type'  => 'numeric', 'name'  => 'streetname', 'class' => 'form-control', 'value' => $value,'placeholder' => "Street name", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label('Premise city' , "label-premise-city");
                    $value = (isset($premise) ? $premise['city'] :'');
                    echo form_input(['type'  => 'numeric', 'name'  => 'city', 'class' => 'form-control', 'value' => $value, 'placeholder' => "City", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label('Premise country' , "label-premise-country");
                    $value = (isset($premise) ? $premise['country'] :'');
                    echo form_input(['type'  => 'text', 'name'  => 'country', 'class' => 'form-control','placeholder' => "Country",'value' => $value, 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_submit('', 'Save', 'class="blue-btn btn mt-3 form-control"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

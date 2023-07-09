<?php
helper('form');
helper('url');

    $hidden_input = [];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    $action = "ingredient/create";

    echo form_open_multipart($action, 'id="premise-create-form" class="premise-card"', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label('Ingredient name' , "label-premise-name");
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'placeholder' => "Name of ingredient", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                            echo form_label('Allergen (Not Required)' , "label-premise-name");
                            echo form_input(['type'  => 'text', 'name'  => 'allergen', 'class' => 'form-control', 'placeholder' => "Allergen"]);
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

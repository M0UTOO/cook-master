<?php

use App\Controllers\Users;

    if ($iduser != session()->get('id') && !isManager()){
        echo "You are not allowed to access this page";
        return;
    }

    $hidden_input = ['user_id' => session()->get('id')];
    $action = "user/profile/account/".$iduser;
    echo form_open_multipart($action, 'id="event-create-form" class=""', $hidden_input);

                echo '<div class="form-group mb-3">';
                echo form_label('Email' , "label-event-name");
                $value = (isset($manager) ? $manager['email'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'email', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Email of user"]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('New Password' , "label-event-name");
                echo form_password("password", "", 'class="form-control"');
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('FirstName' , "label-event-name");
                $value = (isset($manager) ? $manager['firstname'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'firstname', 'class' => 'form-control', 'value' => $value, 'placeholder' => "FirstName"]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('LastName' , "label-event-name");
                $value = (isset($manager) ? $manager['lastname'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'lastname', 'class' => 'form-control', 'value' => $value, 'placeholder' => "LastName"]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label('Profile Picture' , "label-event-picture");
                    echo form_input(['type'  => 'file', 'name'  => 'picture', 'class' => 'form-control']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_submit('', 'Save', 'class="btn mt-3 blue-btn form-control"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

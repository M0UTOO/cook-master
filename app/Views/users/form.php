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
                echo form_label(lang('Common.email') , "label-event-name");
                $value = (isset($client) ? $client['email'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'email', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.email')]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.new-password') , "label-event-name");
                echo form_password("password", "", 'class="form-control"');
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.firstname') , "label-event-name");
                $value = (isset($client) ? $client['firstname'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'firstname', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.firstname')]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.lastname') , "label-event-name");
                $value = (isset($client) ? $client['lastname'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'lastname', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.lastname')]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label(lang('Common.profile-picture') , "label-event-picture");
                    $value = (isset($client) ? $client['profilepicture'] :'');
                    echo form_input(['type'  => 'file', 'name'  => 'picture','value' => $value, 'class' => 'form-control']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.streetName') , "label-event-name");
                $value = (isset($client) ? $client['streetname'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'streetname', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.streetName')]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.country') , "label-event-name");
                $value = (isset($client) ? $client['country'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'country', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.country')]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.city') , "label-event-name");
                $value = (isset($client) ? $client['city'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'city', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.city')]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.streetNumber') , "label-event-name");
                $value = (isset($client) ? $client['streetnumber'] :'');
                echo form_input(['type'  => 'numeric', 'name'  => 'streetnumber', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.streetNumber')]);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.phoneNumber') , "label-event-name");
                $value = (isset($client) ? $client['phonenumber'] :'');
                echo form_input(['type'  => 'numeric', 'name'  => 'phonenumber', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.phoneNumber')]);
                echo '</div>';

                $booleans = [
                    'keepSubscription'  => lang('Common.keepSubscription'),
                ];
                $isChecked = true;

                echo "<div class='form-group'>";
                foreach ($booleans as $key => $value){
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" id="check-'.$key.'" name='. $key .' value="'. $isChecked.'" >';
                    echo '<label class="form-check-label">'. $value .'</label>';
                    echo "</div>";
                }
                echo "</div>";

                echo '<div class="form-group mb-3">';
                    echo form_submit('', lang('Common.save'), 'class="btn mt-3 blue-btn form-control"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

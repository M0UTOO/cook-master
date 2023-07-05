<?php

helper('form');
helper('url')  ;
helper('cookie');

$miniForm = (isset($mini) && $mini == true ) ? true : false;
$email_value = (isset($email)) ? $email : "";
$url = uri_string();
$type= isset($userType) ? $userType : "Client";

$hidden_input = ["Type" => $type, "language" => 1];
$password = lang('Common.password');
$email = lang('Common.email');
$firstname = lang('Common.firstname');
$lastname = lang('Common.lastname');

if ($url == "signIn") {
    $hidden_input['mini'] = true;
}

if ($type == "Client") {
    $signUp = lang('Common.signUp');
    $action = "users/signUp";
} else {
    $signUp = lang('Common.create-account');
    $action = "contractors/create";
}

echo "<div class='column-list rounded-top w-75'>";
echo "<h2>" . $signUp . "<img class='ms-3 mb-3 mt-1' alt='logo' src=" . base_url("assets/images/toque-logo-1-medium.svg") . " /></h2>";

echo form_open_multipart($action, 'id="signUp-form" class="w-75 v-50 d-flex flex-column justify-content-around"', $hidden_input);

echo '<div class="form-group">';
$value = get_cookie('email');
$email_value = isset($email_value) ? $email_value : (isset($value) ? $value : "");
echo form_label(lang('Common.email-placeholder').'<img src=' . base_url("assets/images/svg/icon-mail-red.svg") . ' alt="email-icon" class="icons ms-2 mb-1" />', "label-email");
echo form_input(['type'  => 'email', 'id' => 'sign-up-email-input', 'name'  => 'email', 'value' => $email_value,'class' => 'form-control mb-1', 'placeholder' => $email, 'required' => 'required']);
echo '</div>';


//DISPLAY FULL FORM
if ((isset($mini) && $mini == false) || !isset($mini)){
    //TODO: PHONE NUMBER INPUT to add
    echo '<div class="form-group">';
    echo form_label(lang('Common.password-placeholder'), "label-password");
    echo form_password("password", "", 'class="form-control mb-1" id="sign-up-password-input" required="required" placeholder="' . $password . '"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label(lang('Common.password-confirm-placeholder'), "label-password-2");
    echo form_password("password-confirm", "", 'class="form-control mb-1" required="required" placeholder="' . lang('Common.password-confirm-placeholder') . '"');
    echo '</div>';

    echo '<div class="form-group">';
    $value = get_cookie('firstName');
    echo form_label(lang('Common.firstname-placeholder'), "label-firstname");
    echo form_input(['type'  => 'text', 'id'=> 'sign-up-firstname','name'  => 'firstname','value' => $value, 'class' => 'form-control mb-1', 'placeholder' => $firstname, 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    $value = get_cookie('lastName');
    echo form_label(lang('Common.lastname-placeholder'), "label-lastname");
    echo form_input(['type'  => 'text','id'=> 'sign-up-lastname', 'name'  => 'lastname','value' => $value,  'class' => 'form-control mb-1', 'placeholder' => $lastname, 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">'; //TODO: add country list
    $value = get_cookie('country');
    echo form_label(lang('Common.country-placeholder'), "label-country");
    echo form_input(['type'  => 'text', 'name'  => 'country', 'id'=> 'sign-up-country','value' => $value, 'class' => 'form-control mb-1', 'placeholder' => lang('Common.country'), 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label(lang('Common.profile-picture') , "label-profile-pic");
    echo form_input(['type'  => 'file', 'name'  => 'profilepicture', 'class' => 'form-control mb-1']);
    echo '</div>';

    if (isset($type) && $type == "Contractor")
    {
        echo $this->include("contractors/form.php");
    }
    elseif (isset($type) && $type == "Manager")
    {
        echo $this->include("managers/form.php");
    }

    // TODO: (random password generator)

    echo form_submit('', $signUp, "id='submit_btn' class='btn mt-3 mb-3'");
    echo '<a class="align-self-end mb-3" href='. base_url('signIn'). '>'.lang('Common.already-account').'</a>';

} else {
    echo form_input(['id' => 'arrow-submit', 'type' => 'image', 'src' => base_url("assets/images/svg/arrow-link-red.svg"), 'name'=>'submit', 'alt' => 'arrow-icon', 'class' => 'p-1 m-2 align-self-end']);
}

echo form_close();




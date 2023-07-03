<?php

helper('form');
helper('url')  ;
helper('cookie');

$miniForm = (isset($mini) && $mini == true ) ? true : false;
$email_value = (isset($email)) ? $email : "";
$url = uri_string();
$type= isset($userType) ? $userType : "Client";

$hidden_input = ["Type" => $type, "language" => 1];
$email_placeholder = "E-mail";
$password= "Password";
$firstname = "First name";
$lastname = "Lastname";

if ($url == "signIn") {
    $hidden_input['mini'] = true;
}

if ($type == "Client") {
    $signUp ="Sign Up";
    $action = "users/signUp";
} else {
    $signUp = "Create an account";
    $action = "contractors/create";
}

echo "<div class='column-list rounded-top w-75'>";
echo "<h2>" . $signUp . "<img class='ms-3 mb-3 mt-1' alt='logo' src=" . base_url("assets/images/toque-logo-1-medium.svg") . " /></h2>";

echo form_open_multipart($action, 'id="signUp-form" class="w-75 v-50 d-flex flex-column justify-content-around"', $hidden_input);

echo '<div class="form-group">';
$value = get_cookie('email');
$email_value = ($value != null) ? $value : $email_value;
echo form_label('Your email <img src=' . base_url("assets/images/svg/icon-mail-red.svg") . ' alt="email-icon" class="icons ms-2 mb-1" />', "label-email");
echo form_input(['type'  => 'email', 'id' => 'sign-up-email-input', 'name'  => 'email', 'value' => $email_value,'class' => 'form-control mb-1', 'placeholder' => $email_placeholder, 'required' => 'required']);
echo '</div>';


//DISPLAY FULL FORM
if ((isset($mini) && $mini == false) || !isset($mini)){
    //TODO: PHONE NUMBER INPUT to add
    echo '<div class="form-group">';
    echo form_label("Your password", "label-password");
    echo form_password("password", "", 'class="form-control mb-1" id="sign-up-password-input" required="required" placeholder="Password"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Confirm password', "label-password-2");
    echo form_password("password-confirm", "", 'class="form-control mb-1" required="required" placeholder="' . $password . '"');
    echo '</div>';

    echo '<div class="form-group">';
    $value = get_cookie('firstName');
    echo form_label('Your first name', "label-firstname");
    echo form_input(['type'  => 'text', 'id'=> 'sign-up-firstname','name'  => 'firstname','value' => $value, 'class' => 'form-control mb-1', 'placeholder' => $firstname, 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    $value = get_cookie('lastName');
    echo form_label('Your lastname', "label-lastname");
    echo form_input(['type'  => 'text','id'=> 'sign-up-lastname', 'name'  => 'lastname','value' => $value,  'class' => 'form-control mb-1', 'placeholder' => $lastname, 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">'; //TODO: add country list
    $value = get_cookie('country');
    echo form_label('Your country' , "label-country");
    echo form_input(['type'  => 'text', 'name'  => 'country', 'id'=> 'sign-up-country','value' => $value, 'class' => 'form-control mb-1', 'placeholder' => "Your country", 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Your profile picture (optional)' , "label-profile-pic");
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
    echo '<a class="align-self-end mb-3" href='. base_url('signIn'). '>Already have an account ? Connect.</a>';

} else {
    echo form_input(['id' => 'arrow-submit', 'type' => 'image', 'src' => base_url("assets/images/svg/arrow-link-red.svg"), 'name'=>'submit', 'alt' => 'arrow-icon', 'class' => 'p-1 m-2 align-self-end']);
}

echo form_close();




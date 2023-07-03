<?php

$signIn = "Sign In";
$password = "Password";
$email = "E-mail";

helper('form');

echo "<h2>".$signIn."<img class='ms-3 mb-3' alt='logo' src=". base_url("assets/images/svg/logo-cookmaster/logo-cookmaster-medium.svg") ." /></h2>";
echo form_open("", 'id="signIn-form" class="w-75 v-50 d-flex flex-column justify-content-around"');


    echo '<div class="form-group">';
    echo form_label('Your email <img src='.base_url("assets/images/svg/icon-mail-red.svg").' alt="email-icon" class="icons ms-1 mb-1" />', "label-email");
    echo form_input(['type'  => 'email', 'name'  => 'email' ,'class' => 'form-control', 'placeholder' => $email, 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label("Your password", "label-password");
    echo form_password("password","", 'class="form-control" required="required" placeholder=" ' . $password . '"');
    echo '</div>';
    echo form_submit('',$signIn, "class='btn blue-btn mt-3'");

    echo '<a class="align-self-end" href='. base_url('password/forgottenPassword'). '>Forgotten password ?</a>';

echo form_close();



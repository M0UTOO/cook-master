<?php

$signIn = "Sign In";
$password = "Password";
$email = "E-mail";

helper('form');

echo "<h2>".$signIn."<img alt='logo' src=". base_url("assets/images/toque-logo-1-medium.svg") ." /></h2>";
echo form_open("", 'id="signIn-form" class="w-75 v-50 d-flex flex-column justify-content-around"');

    echo '<div class="form-group">';
    echo form_label('Your email <img src='.base_url("assets/images/svg/menu.svg").' alt="email-icon" class="icons" />', "label-email");
    echo form_input("email", "", 'class="form-control" placeholder="'. $email . '"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label("Your password", "label-password");
    echo form_password("password","", 'class="form-control" placeholder=" ' . $password . '"');
    echo '</div>';
    echo form_submit('',$signIn, "class='btn mt-3'");

    echo '<a class="align-self-end" href='. base_url('password/forgottenPassword'). '>Forgotten password ?</a>';

echo form_close();



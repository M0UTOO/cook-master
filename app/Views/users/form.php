<?php

$signIn = "Se connecter";
$password = "Mot de passe";
$email = "E-mail";

helper('form');

echo form_open("users/create", 'id="user-form"');
//echo '<form action='. base_url('/users/create') .' method="post" accept-charset="utf-8">';
    echo form_password("password","", 'placeholder=" ' . $password . '"');
    echo form_label("Votre mot de passe", "password");
    echo form_input("email", "", 'placeholder="'. $email . '"');
    echo form_label("Votre email", "email");

    echo form_submit('',$signIn);
echo form_close();

<?php

$signIn = "Se connecter";
$password = "Mot de passe";
$email = "E-mail";

helper('form');

echo form_open("", 'id="user-form" class="light-form" onsubmit="test()"');
    echo "<h2>".$signIn."</h2>";
    echo form_password("password","", 'placeholder=" ' . $password . '"');
    echo form_label("Votre mot de passe", "password");
    echo form_input("email", "", 'placeholder="'. $email . '"');
    echo form_label("Votre email", "email");

    echo form_submit('',$signIn);
echo form_close();


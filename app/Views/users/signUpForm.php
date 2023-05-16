<?php
$signUp = "Sign Up";
$email_placeholder = "E-mail";
$password= "Password";
$firstname = "First name";
$surname = "Your surname";

helper('form');
helper('url')  ;

$miniForm = (isset($mini) && $mini == true ) ? true : false;
$email_value = (isset($email)) ? $email : "";
echo $email_value;
$url = uri_string();
$type= isset($userType) ? $userType : "Client";
$hidden_input = ['Type' => $type];

if ($url == "users/signIn") {
    $hidden_input['mini'] = true;
}

echo "<div class='column-list rounded-top w-75'>";
echo "<h2>" . $signUp . "<img alt='logo' src=" . base_url("assets/images/toque-logo-1-medium.svg") . " /></h2>";

echo form_open("users/signUp", 'id="signUp-form" class="w-75 v-50 d-flex flex-column justify-content-around"', $hidden_input);

echo '<div class="form-group">';
echo form_label('Your email <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-email");
echo form_input("email", $email_value, 'class="form-control" placeholder="' . $email_placeholder . '"');
echo '</div>';


//DISPLAY FULL FORM
if ((isset($mini) && $mini == false) || !isset($mini)){

    echo '<div class="form-group">';
    echo form_label("Your password", "label-password");
    echo form_password("password", "", 'class="form-control" placeholder="Password"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Re-enter password <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-password-2");
    echo form_input("password", "", 'class="form-control" placeholder="' . $password . '"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Your first name  <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-email");
    echo form_input("text", "", 'class="form-control" placeholder="' . $firstname . '"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Your surname <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-email");
    echo form_input("text", "", 'class="form-control" placeholder="' . $surname . '"');
    echo '</div>';

    // FOR NOW THIS IS THE CLIENT FORM
    // NEED TO INCLUDE THE OTHER INFO ABOUT CONTRACTORS FOR WHEN MANAGER CREATE THE ACCOUNT CHECK IF IS MANAGER ?.
    // TODO: (random password generator and change password on first connection page)


    echo form_submit('', $signUp, "class='btn mt-3'");
} else {
    echo form_input(['id' => 'arrow-submit', 'type' => 'image', 'src' => base_url("assets/images/svg/menu.svg"), 'name'=>'submit', 'alt' => 'arrow-icon', 'class' => 'icons p-1 m-2 align-self-end']);
}
echo form_close();



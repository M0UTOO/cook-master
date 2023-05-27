<?php

helper('form');
helper('url')  ;

$miniForm = (isset($mini) && $mini == true ) ? true : false;
$email_value = (isset($email)) ? $email : "";
$url = uri_string();
$type= isset($userType) ? $userType : "Client";
var_dump($type);
$hidden_input = ["Type" => $type];
$email_placeholder = "E-mail";
$password= "Password";
$firstname = "First name";
$lastname = "Lastname";

if ($url == "users/signIn") {
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
echo "<h2>" . $signUp . "<img alt='logo' src=" . base_url("assets/images/toque-logo-1-medium.svg") . " /></h2>";

echo form_open_multipart($action, 'id="signUp-form" class="w-75 v-50 d-flex flex-column justify-content-around"', $hidden_input);

echo '<div class="form-group">';
echo form_label('Your email <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-email");
echo form_input(['type'  => 'email', 'name'  => 'email', 'value' => $email_value,'class' => 'form-control', 'placeholder' => $email_placeholder, 'required' => 'required']);
echo '</div>';


//DISPLAY FULL FORM
if ((isset($mini) && $mini == false) || !isset($mini)){
    //TODO: PHONE NUMBER INPUT to add
    echo '<div class="form-group">';
    echo form_label("Your password", "label-password");
    echo form_password("password", "", 'class="form-control" required="required" placeholder="Password"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Re-enter password <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-password-2");
    echo form_password("password", "", 'class="form-control" required="required" placeholder="' . $password . '"');
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Your first name  <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-email");
    echo form_input(['type'  => 'text', 'name'  => 'firstname', 'class' => 'form-control', 'placeholder' => $firstname, 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Your lastname <img src=' . base_url("assets/images/svg/menu.svg") . ' alt="email-icon" class="icons" />', "label-email");
    echo form_input(['type'  => 'text', 'name'  => 'lastname', 'class' => 'form-control', 'placeholder' => $lastname, 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Your country' , "label-country");
    echo form_input(['type'  => 'text', 'name'  => 'country', 'class' => 'form-control', 'placeholder' => "Your country", 'required' => 'required']);
    echo '</div>';

    echo '<div class="form-group">';
    echo form_label('Your profile picture (optional)' , "label-profile-pic");
    echo form_input(['type'  => 'file', 'name'  => 'profilepicture', 'class' => 'form-control']);
    echo '</div>';


    if (isset($type) && $type == "Client"){
        echo '<div>';
        echo '<button type="button" class="btn mt-3" data-bs-toggle="modal" data-bs-target="#subscriptionsModal">Choose your subscription</button>';
        echo '</div>';
    }
    elseif (isset($type) && $type == "Contractor"){

        //TODO : disable picture and presentation input if manager is creating account or do not put it.
        echo '<div class="form-group">';
        echo form_label('Your presentation' , "label-presentation");
        echo form_input(['type'  => 'textarea', 'name'  => 'presentation', 'class' => 'form-control', 'placeholder' => "Your presentation (can use MD format)"]);
        echo '</div>';

        echo '<div class="form-group">';
        echo form_label('Contract start date' , "label-start-date");
        echo form_input(['type'  => 'date', 'name'  => 'contractstart', 'class' => 'form-control', 'placeholder' => "Contract start date", 'required' => 'required']);
        echo '</div>';

        echo '<div class="form-group">';
        echo form_label('Contract end date' , "label-end-date");
        echo form_input(['type'  => 'date', 'name'  => 'contractend', 'class' => 'form-control', 'placeholder' => "Contract end date", 'required' => 'required']);
        echo '</div>';

        //TODO: GET THIS FROM THE DATABASE ONCE IT'S DONE IN THE API
        $typeOfContractors = [
            'cook'  => 'Cook',
            'deliverer'    => 'Deliverer',
            'seller'  => 'Seller',
            'other' => 'Other contractor type',
        ];

        echo '<div class="form-group">';
        echo form_label('Type of contractors' , "label-type-contractor");
        echo form_dropdown('typeOfContractors', $typeOfContractors, 'cook', 'class="form-control"');
        echo '</div>';
    }
    elseif (isset($type) && $type == "Manager"){

        $typeOfManagers = [
            'isitemmanager'  => 'Can manage items',
            'isusermanager'    => 'Can manage users',
            'iseventmanager'  => 'Can manage events',
            'isothermanager' => 'Can manage other things',
            'issuperadmin' => 'Is super admin'
        ];
        $isChecked = true; //but sends back a string cuz all forms send back strings.

        //THIS IS MODIFIABLE ONLY BY MANAGER NOT CONTRACTOR THEMSELVES
        echo "<div class='form-group'>";
        echo "<label>What can this manager manage ?</label>";
        foreach ($typeOfManagers as $key => $value){
            echo '<div class="form-check">';
            echo '<input class="form-check-input" type="checkbox" id="check-'.$key.'" name='. $key .' value="'. $isChecked.'">';
            echo '<label class="form-check-label">'. $value .'</label>';
            echo "</div>";
        }
        echo "</div>";

    }

    // FOR NOW THIS IS THE CLIENT FORM
    // NEED TO INCLUDE THE OTHER INFO ABOUT CONTRACTORS FOR WHEN MANAGER CREATE THE ACCOUNT CHECK IF IS MANAGER ?.
    // TODO: (random password generator and change password on first connection page)


    echo form_submit('', $signUp, "class='btn mt-3'");
    echo '<a class="align-self-end" href='. base_url('users/signIn'). '>Already have an account ? Connect.</a>';

} else {
    echo form_input(['id' => 'arrow-submit', 'type' => 'image', 'src' => base_url("assets/images/svg/menu.svg"), 'name'=>'submit', 'alt' => 'arrow-icon', 'class' => 'icons p-1 m-2 align-self-end']);
}

echo form_close();




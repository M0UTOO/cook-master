<?php

$typeOfManagers = [
    'isitemmanager'  => 'Can manage items',
    'isusermanager'    => 'Can manage users',
    'iseventmanager'  => 'Can manage events',
    'isothermanager' => 'Can manage other things',
    'issuperadmin' => 'Is super admin'
];
$isChecked = true; //but the form sends back a string cuz all forms send back strings in php :/

//IF MANAGER IS NOT USER MANAGER CAN'T CHANGE THIS :
echo "<div class='form-group'>";
echo "<label>What can this manager manage ?</label>";
foreach ($typeOfManagers as $key => $value){
    echo '<div class="form-check">';
    echo '<input class="form-check-input" type="checkbox" id="check-'.$key.'" name='. $key .' value="'. $isChecked.'">';
    echo '<label class="form-check-label">'. $value .'</label>';
    echo "</div>";
}
echo "</div>";

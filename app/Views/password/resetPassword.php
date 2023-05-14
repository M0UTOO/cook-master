<?php

helper('form');
$changePassword = "Change your password";

echo form_open("password/resetPassword", 'id="reset-password-form" class="light-form"');

echo "<h2>" . $changePassword . "</h2>";
echo form_password("password", "", 'placeholder="New password"');
echo form_label("Your new password", "new-password");
echo form_password("password", "", 'placeholder="Confirm your password"');
echo form_label("Confirm new password", "confirmation-password");

echo form_submit('', $changePassword);
echo form_close();
<?= $this->include('layouts/head') ?>

<body>
<?= $this->include('layouts/header') ?>
    <main class="main">
        <?php

        helper('form');
        $email= "E-mail";
        $forgottenPassword = "Forgotten password";

        echo "<h2>".$forgottenPassword."</h2>";
        echo "<p>We will send you a link by mail to reset your password</p>";

        echo form_open("password/sendMailResetPassword", ['id'=>"forgotten-password"]);

                echo '<div class="form-group">';
                echo form_label("Your email", "", ['for' => 'email']);
                echo form_input("email", "", 'placeholder="'. $email . '"');
                //echo '<small id="emailHelp" class="form-text text-muted">Make sure to enter an email adress you have access to.</small>';
                echo '</div>';

                echo form_submit('',"Send the email", );
            echo form_close();
        ?>
        <a href="<?= base_url('users/signIn') ?>">Back to sign In</a>
        </main>
    </body>
</html>
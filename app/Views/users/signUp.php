<?= $this->include('layouts/head') ?>

<body>
<?= $this->include('layouts/header') ?>

    <?php
    if (isset($message)) {
        echo $message;
    }
    echo "<section id='signUp-section' class='w-100 column-list'>";
    echo $this->include('users/signUpForm.php');

    echo "</section>";
    echo $this->include("users/subscriptionsModal.php");
    ?>

</main>
<?= $this->include('layouts/footer') ?>
</body>

</html>
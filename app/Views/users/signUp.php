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
    ?>
</main>
<?= $this->include('layouts/footer') ?>
</body>

<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
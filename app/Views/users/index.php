<?= $this->include('layouts/head') ?>

<body>
    <?= $this->include('layouts/header') ?>
    <main class="main">

        <?php
        if (isset($email)) {
            echo "The form is working, you wrote : " . $email ;
        }

        echo $this->include('users/form.php');
        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>

<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
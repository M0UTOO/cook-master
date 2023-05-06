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

</html>
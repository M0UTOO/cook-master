<?= $this->include('layouts/head') ?>
<body>
    <?= $this->include('layouts/header') ?>
    <main class="main">

        <?php

        use function PHPUnit\Framework\isEmpty;

        if (isset($foo)) {
            echo $foo;
        } else {
            echo $error;
        }
        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>

</html>

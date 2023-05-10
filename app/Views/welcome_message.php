<?= $this->include('layouts/head') ?>
<body>
    <?= $this->include('layouts/header') ?>
    <main class="main">

        <?php

        use function PHPUnit\Framework\isEmpty;
        echo "<p id='api-message' class='.d-none'>";
        if (isset($message)) {
            echo $message;
        }
        echo "</p>"
        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>



</html>

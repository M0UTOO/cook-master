<?= $this->include('layouts/head') ?>
<?= $this->include('layouts/header') ?>
<body>
    <?php

use function PHPUnit\Framework\isEmpty;

        if (isset($foo)) {
            echo $foo;
        } else {
            echo $error;
        }
    ?>
</body>
<?= $this->include('layouts/footer') ?>

</html>

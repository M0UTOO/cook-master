<?= $this->include('layouts/head') ?>

<body>
    <?= $this->include('layouts/header') ?>

        <?php
        if (isset($message)) {
            try {
                echo $message ;
            } catch (\Exception $e) {
                echo "Something went wrong. Please try again later.";
            }
        }
        echo "You can't access this page";
        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
</html>

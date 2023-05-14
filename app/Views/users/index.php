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
        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
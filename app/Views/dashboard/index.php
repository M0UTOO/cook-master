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

    <a href="<?=base_url('dashboard/userManagement')?>" class="card">
        <div class="card-header">
            Featured
        </div>
        <div class="card-body">
            <h5 class="card-title">User management</h5>
            <p class="card-text">There are XXX users.</p>
        </div>
    </a>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
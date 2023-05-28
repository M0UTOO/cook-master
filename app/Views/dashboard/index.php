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
<section id="management" class="">
    <a href="<?=base_url('dashboard/userManagement')?>" class="card">
        <div class="card-body">
            <h5 class="card-title">User management</h5>
            <!--            get user/all and count for under-->
            <p class="card-text">There are XXX users.</p>
        </div>
    </a>

    <a href="<?=base_url('dashboard/subscriptionManagement')?>" class="card">
        <div class="card-body">
            <h5 class="card-title">Subscription management</h5>
            <!--            get user/all and count for under-->
            <p class="card-text">There are XXX subscriptions.</p>
        </div>
    </a>

    <a href="<?=base_url('dashboard/eventManagement')?>" class="card">
        <div class="card-body">
            <h5 class="card-title">Event management</h5>
            <!--            get user/all and count for under-->
            <p class="card-text">There are  XXX events.</p>
        </div>
    </a>

    <a href="<?=base_url('dashboard/shopManagement')?>" class="card">
        <div class="card-body">
            <h5 class="card-title">Shop management</h5>
            <!--            get user/all and count for under-->
            <p class="card-text">There are XXX items.</p>
        </div>
    </a>

    <a href="<?=base_url('dashboard/premisesManagement')?>" class="card">
        <div class="card-body">
            <h5 class="card-title">Premises management</h5>
            <!--            get user/all and count for under-->
            <p class="card-text">There are XXX cooking spaces in XX premises.</p>
        </div>
    </a>
</section>


    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
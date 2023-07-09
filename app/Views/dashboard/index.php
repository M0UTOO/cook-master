<?= $this->include('layouts/head') ?>

<body>
    <?= $this->include('layouts/header') ?>
    <h1 class='mb-3'><?=$title?></h1>
    <p><?= lang('Common.managerRole')?></p>
    <section id="management" class="account-cards">
        <a href="<?=base_url('dashboard/userManagement')?>" class="account-event-card">
                <h5 class="card-title"><?=lang('Common.userManagement')?></h5>
            <p><?=lang('Common.management-explanations-user')?></p>
        </a>

        <a href="<?=base_url('dashboard/subscriptionManagement')?>" class="account-event-card">
                <h5 class="card-title"><?=lang('Common.subscriptionManagement')?></h5>
            <p><?=lang('Common.management-explanations-subscription')?></p>
        </a>

        <a href="<?=base_url('dashboard/eventManagement')?>" class="account-event-card">
                <h5 class="card-title"><?=lang('Common.eventManagement')?></h5>
            <p><?=lang('Common.management-explanations-event')?></p>
        </a>

        <a href="<?=base_url('dashboard/itemManagement')?>" class="account-event-card">
                <h5 class="card-title"><?=lang('Common.itemManagement')?></h5>
            <p><?=lang('Common.management-explanations-item')?></p>
        </a>

        <a href="<?=base_url('dashboard/ingredientManagement')?>" class="account-event-card">
                <h5 class="card-title"><?=lang('Common.ingredientManagement')?></h5>
            <p><?=lang('Common.management-explanations-ingredient')?></p>
        </a>

        <a href="<?=base_url('dashboard/premiseManagement')?>" class="account-event-card">
                <h5 class="card-title"><?=lang('Common.premisesManagement')?></h5>
            <p><?=lang('Common.management-explanations-premises')?></p>
        </a>
    </section>


    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
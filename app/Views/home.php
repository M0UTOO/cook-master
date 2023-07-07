<?= $this->include('layouts/head') ?>
<body>
<?= $this->include('layouts/header') ?>


<section id="home-page">
    <div class="">
        <h1 id="catchphrase-home" class="mb-2"><?=lang('Common.catchphrase')?></h1>
        <h3 id="small-catchphrase-home" class="mb-5"><?=lang('Common.small-catchphrase')?></h3>
        <a href="<?=base_url('users/signUp')?>" id="home-sign-up" class="btn blue-btn"><?=lang('Common.signUp')?></a>
    </div>

    <img src="<?=base_url("assets/images/home-page-person.png")?>" alt="home-page-picture" class=""/>
</section>

<section id="call-to-actions" class="mb-5">
    <a href="<?=base_url('lessons')?>" class="btn blue-btn"><?=lang('Common.btn-learn')?></a>
    <a href="<?=base_url('events')?>" class="btn blue-btn"><?=lang('Common.btn-events')?></a>
    <a href="<?=base_url('cookingSpace')?>" class="btn blue-btn"><?=lang('Common.btn-cookingSpaces')?></a>
</section>

<section id="home-page-orders">
        <h2 class="recommended-orders-title mb-2"><?=lang('Common.recommendedOrders')?></h2>
        <div class="random-orders-container">
            <?php
            foreach ($orders as $order) {
                echo '<div class="food-card col-2">';
                    echo '<div class="food-card-img">';
                        echo '<img src=' . base_url("assets/images/lessons/") . $order->picture . ' alt="lesson-picture" class="order-image-suggestion"/>';
                    echo '</div>';
                    echo '<div class="food-card-content">';
                        echo '<h5 class="food-card-title mt-3">' . $order->name . '</h5>';
                    echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
</section>

</main>
<?= $this->include('layouts/footer') ?>
</body>



</html>
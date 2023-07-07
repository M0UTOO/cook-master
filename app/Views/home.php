<?= $this->include('layouts/head') ?>
<body>
<?= $this->include('layouts/header') ?>


<section id="home-page">
    <div class=""
        <h1 class="mb-2"><?=lang('Common.catchphrase')?></h1>
        <h3 class="mb-5"><?=lang('Common.small-catchphrase')?></h3>
        <button id="home-sign-up" class="btn blue-btn"><?=lang('Common.signIn')?></button>
    </div>

    <img src="<?=base_url("assets/images/home-page-person.png")?>" alt="home-page-picture" class=""/>
</section>
<!--
<section id="call-to-actions">
    <button class="btn blue-btn"><?php /*=lang('Common.login')*/?></button>
    <button class="btn blue-btn"><?php /*=lang('Common.login')*/?></button>
    <button class="btn blue-btn"><?php /*=lang('Common.login')*/?></button>
</section>-->

<!--    <div class="recommended-orders">-->
<!--        <h2 class="recommended-orders-title">--><?php //=lang('Common.recommendedOrders')?><!--</h2>-->
<!--        <div class="random-orders-container">-->
<!--            --><?php
//            foreach ($orders as $order) {
//                echo '<div class="food-card flex-column">';
//                echo '<div class="food-card-img">';
//                echo '<img src=' . base_url("assets/images/lessons/") . $order->picture . ' alt="lesson-picture" class="order-image-suggestion"/>';
//                echo '</div>';
//                echo '<div class="food-card-content">';
//                echo '<h5 class="food-card-title">' . $order->name . '</h5>';
//                echo '</div>';
//                echo '</div>';
//            }
//            ?>
<!--        </div>-->
<!--    </div>-->

</main>
<?= $this->include('layouts/footer') ?>
</body>



</html>
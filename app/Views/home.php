<?= $this->include('layouts/head') ?>
<body>
<?= $this->include('layouts/header') ?>

    <div class="container-home-title">
        <h2 class="incoming-events-title"><?=lang('Common.homePage')?></h2>
    </div>

    <div class="recommended-orders">
        <h2 class="recommended-orders-title"><?=lang('Common.recommendedOrders')?></h2>
        <div class="random-orders-container">
            <?php
            foreach ($orders as $order) {
                echo '<div class="food-card flex-column">';
                echo '<div class="food-card-img">';
                echo '<img src=' . base_url("assets/images/lessons/") . $order->picture . ' alt="lesson-picture" class="order-image-suggestion"/>';
                echo '</div>';
                echo '<div class="food-card-content">';
                echo '<h5 class="food-card-title">' . $order->name . '</h5>';
                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

</main>
<?= $this->include('layouts/footer') ?>
</body>



</html>
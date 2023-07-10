<?php
echo $this->include('layouts/head') ;

echo '<body>';
echo $this->include('layouts/header') ;

$subscription = getSubscription();
    if (!isContractor() && !isManager()){
        if ((isset($subscription) && $subscription['price'] == 0) || !isLoggedIn()) {
        echo '<div class="ad-spot mb-5" style="min-height: 5rem; min-width: 50vw;">';
        echo "<a href=" . base_url("checkout?subscription=3") ."><img src=" . base_url("assets/images/ads/banner.png") . " alt='Sample Ad' /></a>";
        echo '</div>';
        }
    }

    
if (isset($cookingSpace)){
?>

<section id="focus-cooking-space" class="d-flex">
<!--    display picture in big-->
    <div class="room-picture">
        <img src="<?= base_url('assets/images/cookingSpaces/' . $cookingSpace['picture']) ?>" alt='use profile picture'>
    </div>

    <?php
    if (isset($cookingSpace['isAvailable'])) {
        if ($cookingSpace['isAvailable'] == 1) {
            $available = lang('Common.available');
        } else {
            $available = lang('Common.notAvailable');
        }
    }
    ?>

    <div class="room-infos">
        <h3 class="mb-5"><?= $cookingSpace['name'] ?></h3>
        <p><?=lang('Common.roomCapacity')?><?= $cookingSpace['size'] ?></p>
        <p><?=lang('Common.currentState')?><?= $available ?></p>
        <p><?=lang('Common.pricePerHour')?><?= $cookingSpace['pricePerHour'] ?></p>
        <p><?=lang('Common.premise')?><?= $premise[0]->name ?></p>
    </div>

</section>
<?php
    echo $this->include('cookingSpace/cookingspace-items') ;
    echo $this->include('cookingSpace/availability') ;} ?>


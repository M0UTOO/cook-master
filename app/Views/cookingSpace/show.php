<?php
echo $this->include('layouts/head') ;

echo '<body>';
echo $this->include('layouts/header') ;

if (isset($cookingSpace)){
?>

<section id="focus-cooking-space" class="d-flex">
<!--    display picture in big-->
    <div class="room-picture">
        <img src="<?= base_url('assets/images/cookingSpaces/' . $cookingSpace['picture']) ?>" alt='use profile picture'>
    </div>

    <div class="room-infos">
        <h3 class="mb-5"><?= $cookingSpace['name'] ?></h3>
        <p>Room capacity: <?= $cookingSpace['size'] ?></p>
        <p>Current state: <?= $cookingSpace['isAvailable'] ?></p>
        <p>Price per hour: <?= $cookingSpace['pricePerHour'] ?></p>
        <p>Premise: Paris 4 - Premise Address</p>
    </div>

</section>
<?php
   // echo $this->include('cookingSpace/cookingspace-items') ;
    echo $this->include('cookingSpace/availability') ;} ?>


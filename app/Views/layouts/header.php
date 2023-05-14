<?php helper('html') ?>
<!-- ABOVE LINE TO USE SOME NATIVES HELPERS LIKE img TAG or form tag-->

<header class="header">
    <div class="container-fluid" id="navbar">
        <a class="navbar-brand" id="logo" href="#"><?= img(base_url("assets/images/toque-logo-1-medium.svg")) ?></a>
        <a class="navbar-brand" id="brand-name" href="#">Cookmaster</a>
        <a class="navbar-brand" id="menu-icon" href="#"><?= img(base_url("assets/images/svg/menu.svg")) ?></a>
    </div>
</header>

<main class="main d-flex flex-column align-items-center">
    <?php
    if ((session()->get('id')) !== null ){
        echo "Logged In - ID: " . session()->get('id');
        echo "<br>";
    } else {
        echo "You are not logged in";
    }
?>


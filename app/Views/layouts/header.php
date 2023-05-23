<?php helper('html') ?>
<!-- ABOVE LINE TO USE SOME NATIVES HELPERS LIKE img TAG or form tag-->

<header class="header">
    <div class="container-fluid" id="navbar">
        <a class="navbar-brand" id="logo" href="#"><?= img(base_url("assets/images/toque-logo-1-medium.svg")) ?></a>
        <a class="navbar-brand" id="brand-name" href="#">Cookmaster</a>
        <button id="menu-icon" class="navbar-toggler" type="button">
            <span class="burger-menu-icon"><?= img(base_url("assets/images/svg/menu.svg")) ?></span>
        </button>
    </div>
</header>

<nav id="burger-menu" class="d-none vh-100 d-flex flex-column align-items-center mt-1">
    <?php
        if (isset($isConnected)){
            echo '<a class="m-2 p-3" href="'.base_url('users/signOut').'" class="nav-link">Sign Out</a>';
            echo '<a class="m-2 p-3" href="'.base_url('dashboard').'" class="nav-link">Dashboard</a>';
            if (isset($isAdmin) && $isAdmin){
                echo '<a class="m-2 p-3" href="'.base_url('dashboard').'" class="nav-link">Dashboard (Admin)</a>';
            }
        }
        else
        {
            echo '<a class="m-2 p-3" href="'. base_url('users/signIn').'" class="nav-link">Sign In</a>';
            echo '<a class="m-2 p-3" href="'. base_url('users/signUp').'" class="nav-link">Sign Up</a>';
        }
    ?>
    <a class="m-2 p-3" href="#" class="nav-link">Next page</a>
</nav>

<main class="main d-flex flex-column align-items-center">
    <?php
    if ((session()->get('id')) !== null ){
        echo "Logged In - ID: " . session()->get('id');
        echo "<br>";
    } else {
        echo "You are not logged in";
    }
?>


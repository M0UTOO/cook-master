<?php
helper('html') ?>
<!-- ABOVE LINE TO USE SOME NATIVES HELPERS LIKE img TAG or form tag-->

<header class="header">
    <div class="container-fluid" id="navbar">
        <a class="navbar-brand" id="logo" href="/"><?= img(base_url("assets/images/toque-logo-1-medium.svg")) ?></a>
        <a class="navbar-brand" id="brand-name" href="/">Cookmaster</a>
        <button id="menu-icon" class="navbar-toggler" type="button">
            <span class="burger-menu-icon"><?= img(base_url("assets/images/svg/menu.svg")) ?></span>
        </button>
    </div>
    <div>
        <a class="" href="/" id="nav-bar-signIn"></a>
    </div>

</header>

<nav id="burger-menu" class="d-none vh-100 d-flex flex-column align-items-center mt-1">
    <a class="m-2 p-3" href="/lessons" class="nav-link">Our Lessons</a>
    <a class="m-2 p-3" href="/events" class="nav-link">Our Events(in construction)</a>
    <a class="m-2 p-3" href="#" class="nav-link">Our shop (in construction)</a>
    <a class="m-2 p-3" href="#" class="nav-link">Cook in our spaces (in construction)</a>

    <?php
        if (isLoggedIn()) {
            if ((isset($isManager) && $isManager) || isManager()) {
                echo '<a class="m-2 p-3" href="' . base_url('dashboard') . '" class="nav-link">Dashboard (Manager)</a>';
            }
            echo '<a class="m-2 p-3" href="' . base_url('user/profile') . '" class="nav-link">Your account</a>';
            echo '<a class="m-2 p-3" href="' . base_url('/signOut') . '" class="nav-link">Sign Out</a>';
        }
            else
        {
            echo '<a class="m-2 p-3" href="'. base_url('/signIn').'" class="nav-link">Sign In</a>';
            echo '<a class="m-2 p-3" href="'. base_url('users/signUp').'" class="nav-link">Sign Up</a>';
        }
    ?>

</nav>

<main class="main d-flex flex-column align-items-center">
    <?php
            //DISPLAY FLASH MESSAGES
            if (session()->getFlashdata('message')){
                echo '<div class="alert alert-warning" role="alert">';
                echo session()->getFlashdata('message');
                echo '</div>';
            }


?>


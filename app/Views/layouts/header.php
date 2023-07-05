<?php
helper('html') ?>
<!-- ABOVE LINE TO USE SOME NATIVES HELPERS LIKE img TAG or form tag-->

<header class="header">
    <div class="container-fluid" id="navbar">
        <a class="navbar-brand" id="logo" href="/"><?= img(base_url("assets/images/toque-logo-1-medium.svg")) ?></a>
        <a class="navbar-brand" id="brand-name" href="/">Cookmaster</a>
        <button id="menu-icon" class="navbar-toggler" type="button">
        </button>
    </div>
    <div>
        <a class="" href="/" id="nav-bar-signIn"></a>
    </div>

</header>

<nav id="burger-menu" class="d-none vh-100 d-flex flex-column align-items-center mt-1">
    <a class="m-2 p-3" href="/lessons" class="nav-link"><?=lang('Common.burger-menu.lessons')?></a>
    <a class="m-2 p-3" href="/events" class="nav-link"><?=lang('Common.burger-menu.events')?></a>
    <a class="m-2 p-3" href="/cookingSpace" class="nav-link"><?=lang('Common.burger-menu.cookingSpaces')?></a>
    <a class="m-2 p-3" href="/subscriptions" class="nav-link"><?=lang('Common.burger-menu.subscriptions')?></a>
    <?php
    if (isContractor()) {
        echo '<a class="m-2 p-3" href="' . base_url('eventContractor/index/' . session()->get('id') . '') . '" class="nav-link">My events</a>';
    }
    ?>

    <?php
        if (isLoggedIn()) {
            if ((isset($isManager) && $isManager) || isManager()) {
                echo '<a class="m-2 p-3" href="' . base_url('dashboard') . '" class="nav-link">'.lang('Common.burger-menu.dashboard').'</a>';
            }
            echo '<a class="m-2 p-3" href="' . base_url('user/profile') . '" class="nav-link">'.lang('Common.burger-menu.yourAccount').'</a>';
            echo '<a class="m-2 p-3" href="' . base_url('/signOut') . '" class="nav-link">'.lang('Common.burger-menu.signOut').'</a>';
        }
            else
        {
            echo '<a class="m-2 p-3" href="'. base_url('/signIn').'" class="nav-link">'.lang('Common.signIn').'</a>';
            echo '<a class="m-2 p-3" href="'. base_url('users/signUp').'" class="nav-link">'.lang('Common.signUp').'</a>';
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

            if (isset($message)){
                echo '<div class="alert alert-warning" role="alert">';
                echo $message;
                echo '</div>';
            }


?>


<?= $this->include('layouts/head') ?>

<body>

    <?= $this->include('layouts/header') ?>

<!--TODO: ADD DASHBOARD NAV-->

        <?php

        // echo '<section>';

        // echo '<div class="d-flex flex-row">';
        // echo '<div class="d-flex flex-column">';
        // echo '<h2 class="mb-3">Personal information</h2>';
        // echo '<div class="d-flex flex-row">';
        // echo '<div class="d-flex flex-column">';
        // echo '<p>First name: ' . $user['firstname'] . '</p>';
        // echo '<p>Last name: ' . $user['lastname'] . '</p>';
        // echo '<p>Email: ' . $user['email'] . '</p>';
        // if (isClient()) {
        //     echo '<p>Phone number: ' . $client['phonenumber'] . '</p>';
        //     echo '<div class="d-flex flex-column">';
        //     echo '<p>Address: ' . $client['streetnumber'] . ' ' . $client['streetname'] . '</p>';
        //     echo '<p>City: ' . $client['city'] . '</p>';
        //     echo '<p>Country: ' . $client['country'] . '</p>';
        //     echo '</div>';
        // }
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';
        // echo '<div class="d-flex flex-column">';

        // echo '</section>';
        //echo '<section>';

        // echo '<div class="d-flex flex-row">';
        // echo '<div class="d-flex flex-column">';
        // echo '<h2 class="mb-3">Personal information</h2>';
        // echo '<div class="d-flex flex-row">';
        // echo '<div class="d-flex flex-column">';
        // echo '<p>First name: ' . $user['firstname'] . '</p>';
        // echo '<p>Last name: ' . $user['lastname'] . '</p>';
        // echo '<p>Email: ' . $user['email'] . '</p>';
        // if (isClient()) {
        //     echo '<p>Phone number: ' . $client['phonenumber'] . '</p>';
        //     echo '<div class="d-flex flex-column">';
        //     echo '<p>Address: ' . $client['streetnumber'] . ' ' . $client['streetname'] . '</p>';
        //     echo '<p>City: ' . $client['city'] . '</p>';
        //     echo '<p>Country: ' . $client['country'] . '</p>';
        //     echo '</div>';
        // }
        // echo '</div>';
        // echo '</div>';
        // echo '</div>';
        // echo '<div class="d-flex flex-column">';

        // echo '</section>'
        echo '<section class="account-cards" style="min-width: 100%;">';
        echo "<h1 class='mb-3'>" . $title . "</h1>";
        echo '<div class="account-row">';
        $redirection = base_url("user/profile/comingEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div1" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">Coming events</h2>';
        echo '</div>';
        if (isset($comingEvents) && !empty($comingEvents)) {
            echo '<div style="min-width: 100%;">';
            if (sizeof($comingEvents) == 1) {
                echo '<p>You have ' . sizeof($comingEvents) . ' coming event</p>';
            } else {
                echo '<p>You have ' . sizeof($comingEvents) . ' coming events</p>';
            }
            echo '</div>';
        } else {
            echo '<div style="min-width: 100%;">';
            echo '<p>No coming events</p>';
            echo '</div>';
        }
        echo '</div>';
        $redirection = base_url("user/profile/pastEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div2" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">Past events</h2>';
        echo '</div>';
        if (isset($pastEvents) && !empty($pastEvents)) {
            echo '<div style="min-width: 100%;">';
            if (sizeof($pastEvents) == 1) {
                echo '<p>You have ' . sizeof($pastEvents) . ' past event</p>';
            } else {
                echo '<p>You have ' . sizeof($pastEvents) . ' past events</p>';
            }
            echo '</div>';
        } else {
            echo '<p>No past events</p>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';

        echo '<section class="account-cards" style="min-width: 100%;">';
        echo '<div class="account-row">';
        $redirection = base_url("user/profile/pastOrders");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div7" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">Past orders</h2>';
        echo '</div>';
        if (isset($pastOrders) && !empty($pastOrders)) {
            echo '<div style="min-width: 100%;">';
            if (sizeof($pastOrders) == 1) {
                echo '<p>You have ' . sizeof($pastOrders) . ' past order</p>';
            } else {
                echo '<p>You have ' . sizeof($pastOrders) . ' past orders</p>';
            }
            echo '</div>';
        } else {
            echo '<div style="min-width: 100%;">';
            echo '<p>No past orders</p>';
            echo '</div>';
        }
        echo '</div>';
        $redirection = base_url("user/profile/pastReservations");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div8" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">Past reservations</h2>';
        echo '</div>';
        if (isset($pastReservations) && !empty($pastReservations)) {
            echo '<div style="min-width: 100%;">';
            if (sizeof($pastReservations) == 1) {
                echo '<p>You have ' . sizeof($pastReservations) . ' past reservation</p>';
            } else {
                echo '<p>You have ' . sizeof($pastReservations) . ' past reservations</p>';
            }
            echo '</div>';
        } else {
            echo '<p>No past reservations</p>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';

        echo '<section class="account-cards" style="min-width: 100%;">';
        echo '<div class="account-row">';
        $redirection = base_url("user/profile/comments");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div3" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Comments</h2>';
        echo '</div>';
        if (isset($comments) && !empty($comments)) {
            echo '<div style="min-width: 100%;">';
            if (sizeof($comments) == 1) {
                echo '<p>You have ' . sizeof($comments) . ' comment</p>';
            } else {
                echo '<p>You have ' . sizeof($comments) . ' comments</p>';
            }
            echo '</div>';
        } else {
            echo '<div style="min-width: 100%;">';
            echo '<p>No comments</p>';
            echo '</div>';
        }
        echo '</div>';
        $redirection = base_url("users/profile/account");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div4" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Account</h2>';
        echo '</div>';
        echo '<div style="min-width: 100%;">';
        echo '<p>See your account informations</p>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</section>';

        echo '<section class="account-cards" style="min-width: 100%;">';
        echo '<div class="account-row">';
        $redirection = base_url("users/profile/comingEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div5" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Bills</h2>';
        echo '</div>';
        if (isset($bills) && !empty($bills)) {
            echo '<div style="min-width: 100%;">';
            if (sizeof($bills) == 1) {
                echo '<p>You have ' . sizeof($bills) . ' bill</p>';
            } else {
                echo '<p>You have ' . sizeof($bills) . ' bills</p>';
            }
            echo '</div>';
        } else {
            echo '<div style="min-width: 100%;">';
            echo '<p>No Bills</p>';
            echo '</div>';
        }
        echo '</div>';
        $redirection = base_url("users/profile/pastEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div6" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Formations</h2>';
        echo '</div>';
        if (isset($formations) && !empty($formations)) {
            echo '<div style="min-width: 100%;">';
            if (sizeof($formations) == 1) {
                echo '<p>You have ' . sizeof($formations) . ' formation</p>';
            } else {
                echo '<p>You have ' . sizeof($formations) . ' formations</p>';
            }
            echo '</div>';
        } else {
            echo '<p>No Formations</p>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';



        echo '<a href='.base_url('/subscriptions').'>Change subscriptions</a>';
        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/div.js')?>></script>
</html>
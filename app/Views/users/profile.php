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
        $redirection = base_url("users/profile/comingEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">Coming events</h2>';
        echo '</div>';
        if (isset($comingEvents) && !empty($comingEvents)) {
            foreach ($comingEvents as $event) {
                echo '<div class="d-flex flex-row">';
                echo '<div class="d-flex flex-column">';
                echo '<p>' . $event['name'] . '</p>';
                echo '<p>' . $event['starttime'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div style="min-width: 100%;">';
            echo '<p>No coming events</p>';
            echo '</div>';
        }
        echo '</div>';
        $redirection = base_url("users/profile/pastEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">Past events</h2>';
        echo '</div>';
        if (isset($pastEvents) && !empty($pastEvents)) {
            foreach ($pastEvents as $event) {
                echo '<div class="d-flex flex-row">';
                echo '<div class="d-flex flex-column">';
                echo '<p>' . $event['name'] . '</p>';
                echo '<p>' . $event['starttime'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No past events</p>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';

        echo '<section class="account-cards" style="min-width: 100%;">';
        echo '<div class="account-row">';
        $redirection = base_url("users/profile/comingEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Comments</h2>';
        echo '</div>';
        if (isset($comments) && !empty($comments)) {
            foreach ($comments as $event) {
                echo '<div class="d-flex flex-row">';
                echo '<div class="d-flex flex-column">';
                echo '<p>' . $event['name'] . '</p>';
                echo '<p>' . $event['starttime'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div style="min-width: 100%;">';
            echo '<p>No comments</p>';
            echo '</div>';
        }
        echo '</div>';
        $redirection = base_url("users/profile/pastEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Account</h2>';
        echo '</div>';
        if (isset($account) && !empty($account)) {
            foreach ($account as $event) {
                echo '<div class="d-flex flex-row">';
                echo '<div class="d-flex flex-column">';
                echo '<p>' . $event['name'] . '</p>';
                echo '<p>' . $event['starttime'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No Account</p>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';

        echo '<section class="account-cards" style="min-width: 100%;">';
        echo '<div class="account-row">';
        $redirection = base_url("users/profile/comingEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Bills</h2>';
        echo '</div>';
        if (isset($bills) && !empty($bills)) {
            foreach ($bills as $event) {
                echo '<div class="d-flex flex-row">';
                echo '<div class="d-flex flex-column">';
                echo '<p>' . $event['name'] . '</p>';
                echo '<p>' . $event['starttime'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div style="min-width: 100%;">';
            echo '<p>No Bills</p>';
            echo '</div>';
        }
        echo '</div>';
        $redirection = base_url("users/profile/pastEvents");
        echo '<div class="d-flex flex-column account-event-card" id="clickable-div" data-href='.$redirection.'>';
        echo '<div class="card-title">';
        echo '<h2 class="mb-3">My Formations</h2>';
        echo '</div>';
        if (isset($pastEvents) && !empty($pastEvents)) {
            foreach ($pastEvents as $event) {
                echo '<div class="d-flex flex-row">';
                echo '<div class="d-flex flex-column">';
                echo '<p>' . $event['name'] . '</p>';
                echo '<p>' . $event['starttime'] . '</p>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<p>No Formations</p>';
        }
        echo '</div>';
        echo '</div>';
        echo '</section>';


        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/div.js')?>></script>
</html>
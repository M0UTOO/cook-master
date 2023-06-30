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
        echo '<section>';

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
        echo '<section class="account-cards">';
        echo '<div class="d-flex flex-column">';
        echo '<div class="d-flex flex-row">';
        $redirection = base_url("users/profile/comingEvents");
        echo '<div class="d-flex flex-column coming-event-card" id="clickable-div" data-href='.$redirection.'>';
        echo '<h2 class="mb-3">Coming events</h2>';
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
            echo '<p>No coming events</p>';
        }

        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/div.js')?>></script>
</html>
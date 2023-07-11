<?= $this->include('layouts/head') ?>

<body>

    <?= $this->include('layouts/header') ?>

        <?php

        echo "<h1 class='mb-3'>" . $title . "</h1>";

        if(isset($formations) && !empty($formations)) {

            echo '<div class="d-flex flex-wrap justify-content-center">';

            foreach ($formations as $formation) {

                echo '<div class="account-row">';
                echo '<div class="d-flex flex-column account-formation-card">';
                echo '<div class="card-title">';
                echo '<h2 class="mb-3">' . $formation->nameeventgroup . '</h2>';
                echo '</div>';
                echo '<div style="min-width: 100%;">';
                echo '<p>Events completed : ' . $formation->count . '/' . $formation->eventcount . '</p>';
                echo '</div>';
                if ($formation->count > $formation->eventcount) {
                    echo '<div class="d-flex flex-row">';
                    echo '<a class="me-3" href="/user/formation/certificate/' . $formation->ideventgroup .'/' . getCurrentUserId() . '"><img src=' . base_url("assets/images/svg/certificate-icon.svg") . ' alt="certificate-icon" class="icons-medium" /></a>';
                    echo '</div>';
                }
                echo '</div>';
                echo '</div>';
            }

            echo '</div>';

        } else {
            echo '<p>No Formations</p>';
        }

        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
</html>
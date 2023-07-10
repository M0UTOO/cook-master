<?= $this->include('layouts/head') ?>

<body>

    <?= $this->include('layouts/header') ?>

        <?php

        echo "<h1 class='mb-3'>" . $title . "</h1>";

        if(isset($bills) && !empty($bills)) {

            echo '<div class="d-flex flex-wrap justify-content-center">';

            foreach ($bills as $bill) {

                echo '<div class="account-row">';
                echo '<div class="d-flex flex-column account-formation-card">';
                echo '<div class="card-title">';
                echo '<h2 class="mb-3">' . $bill->type . '</h2>';
                echo '</div>';
                echo '<div style="min-width: 100%;">';
                echo '<p>Bill date : ' . $bill->createdat . '</p>';
                echo '</div>';
                echo '<div class="d-flex flex-row">';
                echo '<a class="me-3" href="/assets/bills/' . getCurrentUserId() . '/' . $bill->name . '" download><img src=' . base_url("assets/images/svg/print-icon-blue.svg") . ' alt="certificate-icon" class="icons-medium" /></a>';
                echo '</div>';
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
<?= $this->include('layouts/head') ?>

<body>

    <?= $this->include('layouts/header') ?>

        <?php

        echo '<section>';
        echo '<div class="d-flex flex-column justify-content-center card-suggestion-event-blue">';
        echo '<h1>' . $title . '</h1>';
        echo '<img src=' . base_url("assets/images/users/" . $user['profilepicture']) . ' alt="profile_picture" class="icons-medium"/>';
        echo '<p class="mt-3">' . lang('Common.name') . ' : ' . $user['firstname'] . ' ' . $user['lastname'] . '</p>';
        echo '<p>' . lang('Common.email') . ' : ' . $user['email'] . '</p>';
        if (isClient()) {
            echo '<p>' . lang('Common.fidelitypoints') . ' : ' . $client['fidelitypoints'] . '</p>';
            echo '<p>' . lang('Common.address') . ' : ' . $client['streetnumber'] . ' ' . $client['streetname'] . '</p>';
            echo '<p>' . lang('Common.town') . ' : ' . $client['city'] . ' - ' . $client['country'] . '</p>';
            echo '<p>' . lang('Common.phoneNumber') . ' : ' . $client['phonenumber'] . '</p>';
            // echo '<p>' . getSubscription() . '</p>';
        } else if (isContractor()) {
            echo '<p>' . lang('Common.description') . ' : ' . $contractor['presentation'] . '</p>';
            echo '<p>' . lang('Common.type') . ' : ' . $type[0]->name . '</p>';
            echo '<p>' . lang('Common.contractStart') . ' : ' . $contractor['contractstart'] . '</p>';
            echo '<p>' . lang('Common.contractEnd') . ' : ' . $contractor['contractend'] . '</p>';
        } else if (isManager()) {
            if (isset($manager['isitemmanager']) && $manager['isitemmanager'] == 1) {
                $isitemmanager = 'Yes'; 
            } else {
                $isitemmanager = 'No';
            }
            if (isset($manager['isclientmanager']) && $manager['isclientmanager'] == 1) {
                $isclientmanager = 'Yes'; 
            } else {
                $isclientmanager = 'No';
            }
            if (isset($manager['iscontractormanager']) && $manager['iscontractormanager'] == 1) {
                $iscontractormanager = 'Yes'; 
            } else {
                $iscontractormanager = 'No';
            }
            if (isset($manager['issuperadmin']) && $manager['issuperadmin'] == 1) {
                $issuperadmin = 'Yes'; 
            } else {
                $issuperadmin = 'No';
            }
            echo '<p>' . lang('Common.isItemManager') . ' : ' . $isitemmanager . '</p>';
            echo '<p>' . lang('Common.isClientManager') . ' : ' . $isclientmanager . '</p>';
            echo '<p>' . lang('Common.isContractorManager') . ' : ' . $iscontractormanager . '</p>';
            echo '<p>' . lang('Common.isSuperAdmin') . ' : ' . $issuperadmin . '</p>';
        }
        echo '</div>';
        echo '</section>';

        if (isClient()) {
            
            echo '<section class="account-cards mt-5" style="min-width: 100%;">';
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
            $redirection = base_url("user/profile/account/". session()->get('id') ."");
            echo '<div class="d-flex flex-column account-event-card" id="clickable-div4" data-href='.$redirection.'>';
            echo '<div class="card-title">';
            echo '<h2 class="mb-3">' . lang('Common.options') . '</h2>';
            echo '</div>';
            echo '<div style="min-width: 100%;">';
            echo '<p>' . lang('Common.changeinfo') . '</p>';
            echo '</div>';
            echo '</div>';
            echo '</div>';
            echo '</section>';

            echo '<section class="account-cards" style="min-width: 100%;">';
            echo '<div class="account-row">';
            $redirection = base_url("user/profile/comingEvents");
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
            $redirection = base_url("user/profile/formations");
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
                echo '<div style="min-width: 100%;">';
                echo '<p>No formations</p>';
                echo '</div>';
            }
            echo '</div>';
            echo '</div>';
            echo '</section>';
        }

        if (isContractor() || isManager()) {
            $redirection = base_url("user/profile/account/". session()->get('id') ."");
            echo '<div class="d-flex flex-column account-event-card mt-5" id="clickable-div1" data-href='.$redirection.'>';
            echo '<div class="card-title">';
            echo '<h2 class="mb-3">' . lang('Common.options') . '</h2>';
            echo '</div>';
            echo '<div style="min-width: 100%;">';
            echo '<p>' . lang('Common.changeinfo') . '</p>';
            echo '</div>';
            echo '</div>';
        }



        ?>

    </main>
    <?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/div.js')?>></script>
</html>
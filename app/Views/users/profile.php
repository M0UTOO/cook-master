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
                $isitemmanager = lang('Common.yes'); 
            } else {
                $isitemmanager = lang('Common.no');
            }
            if (isset($manager['isclientmanager']) && $manager['isclientmanager'] == 1) {
                $isclientmanager = lang('Common.yes'); 
            } else {
                $isclientmanager = lang('Common.no');
            }
            if (isset($manager['iscontractormanager']) && $manager['iscontractormanager'] == 1) {
                $iscontractormanager = lang('Common.yes'); 
            } else {
                $iscontractormanager = lang('Common.no');
            }
            if (isset($manager['issuperadmin']) && $manager['issuperadmin'] == 1) {
                $issuperadmin = lang('Common.yes'); 
            } else {
                $issuperadmin = lang('Common.no');
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
            echo '<h2 class="mb-3">' . lang('Common.myComingEvents') . '</h2>';
            echo '</div>';
            if (isset($comingEvents) && !empty($comingEvents)) {
                echo '<div style="min-width: 100%;">';
                if (sizeof($comingEvents) == 1) {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($comingEvents) . ' ' . lang('Common.comingEvent') . '</p>';
                } else {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($comingEvents) . ' ' . lang('Common.comingEvents') . '</p>';
                }
                echo '</div>';
            } else {
                echo '<div style="min-width: 100%;">';
                echo '<p>' . lang('Common.noComingEvents') . '</p>';
                echo '</div>';
            }
            echo '</div>';
            $redirection = base_url("user/profile/pastEvents");
            echo '<div class="d-flex flex-column account-event-card" id="clickable-div2" data-href='.$redirection.'>';
            echo '<div class="card-title">';
            echo '<h2 class="mb-3">' . lang('Common.myPastEvents') . '</h2>';
            echo '</div>';
            if (isset($pastEvents) && !empty($pastEvents)) {
                echo '<div style="min-width: 100%;">';
                if (sizeof($pastEvents) == 1) {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($pastEvents) . ' ' . lang('Common.pastEvent') . '</p>';
                } else {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($pastEvents) . ' ' . lang('Common.pastEvents') . '</p>';
                }
                echo '</div>';
            } else {
                echo '<p>' . lang('Common.noPastEvents') . '</p>';
            }
            echo '</div>';
            echo '</div>';
            echo '</section>';

            echo '<section class="account-cards" style="min-width: 100%;">';
            echo '<div class="account-row">';
            $redirection = base_url("user/profile/pastOrders");
            echo '<div class="d-flex flex-column account-event-card" id="clickable-div7" data-href='.$redirection.'>';
            echo '<div class="card-title">';
            echo '<h2 class="mb-3">' . lang('Common.myOrders') . '</h2>';
            echo '</div>';
            if (isset($pastOrders) && !empty($pastOrders)) {
                echo '<div style="min-width: 100%;">';
                if (sizeof($pastOrders) == 1) {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($pastOrders) . ' ' . lang('Common.order') . '</p>';
                } else {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($pastOrders) . ' ' . lang('Common.orders') . '</p>';
                }
                echo '</div>';
            } else {
                echo '<div style="min-width: 100%;">';
                echo '<p>' . lang('Common.noOrders') . '</p>';
                echo '</div>';
            }
            echo '</div>';
            $redirection = base_url("user/profile/pastReservations");
            echo '<div class="d-flex flex-column account-event-card" id="clickable-div8" data-href='.$redirection.'>';
            echo '<div class="card-title">';
            echo '<h2 class="mb-3">' . lang('Common.myReservations') . '</h2>';
            echo '</div>';
            if (isset($pastReservations) && !empty($pastReservations)) {
                echo '<div style="min-width: 100%;">';
                if (sizeof($pastReservations) == 1) {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($pastReservations) . ' ' . lang('Common.reservation') . '</p>';
                } else {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($pastReservations) . ' ' . lang('Common.reservations') . '</p>';
                }
                echo '</div>';
            } else {
                echo '<p>' . lang('Common.noReservations') . '</p>';
            }
            echo '</div>';
            echo '</div>';
            echo '</section>';

            echo '<section class="account-cards" style="min-width: 100%;">';
            echo '<div class="account-row">';
            $redirection = base_url("user/profile/comments");
            echo '<div class="d-flex flex-column account-event-card" id="clickable-div3" data-href='.$redirection.'>';
            echo '<div class="card-title">';
            echo '<h2 class="mb-3">' . lang('Common.myComments') . '</h2>';
            echo '</div>';
            if (isset($comments) && !empty($comments)) {
                echo '<div style="min-width: 100%;">';
                if (sizeof($comments) == 1) {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($comments) . ' ' . lang('Common.comment') . '</p>';
                } else {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($comments) . ' '. lang('Common.comments') . '</p>';
                }
                echo '</div>';
            } else {
                echo '<div style="min-width: 100%;">';
                echo '<p>' . lang('Common.noComments') . '</p>';
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
            echo '<h2 class="mb-3">' . lang('Common.myBills') . '</h2>';
            echo '</div>';
            if (isset($bills) && !empty($bills)) {
                echo '<div style="min-width: 100%;">';
                if (sizeof($bills) == 1) {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($bills) . ' ' . lang('Common.bill') . '</p>';
                } else {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($bills) . ' ' . lang('Common.bills') . '</p>';
                }
                echo '</div>';
            } else {
                echo '<div style="min-width: 100%;">';
                echo '<p>' . lang('Common.noBills') . '</p>';
                echo '</div>';
            }
            echo '</div>';
            $redirection = base_url("user/profile/formations");
            echo '<div class="d-flex flex-column account-event-card" id="clickable-div6" data-href='.$redirection.'>';
            echo '<div class="card-title">';
            echo '<h2 class="mb-3">' . lang('Common.myFormations') . '</h2>';
            echo '</div>';
            if (isset($formations) && !empty($formations)) {
                echo '<div style="min-width: 100%;">';
                if (sizeof($formations) == 1) {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($formations) . ' ' . lang('Common.formation') . '</p>';
                } else {
                    echo '<p>' . lang('Common.youHave') . ' ' . sizeof($formations) . ' ' . lang('Common.formations') . '</p>';
                }
                echo '</div>';
            } else {
                echo '<div style="min-width: 100%;">';
                echo '<p>' . lang('Common.noFormations') . '</p>';
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
<?php

echo $this->include('layouts/head') ;


    echo '<body>';
    echo $this->include('layouts/header') ;
    helper('form');

    echo "<h1 class='mb-3 h1-center'>" . $title . "<img alt='logo' width='50px' class='ms-2' src=" . base_url("assets/images/svg/start-event-icon-blue.svg") . " /></h1>";


        if (isManager()){
            echo $this->include('event/eventOptionsModal') ;
            echo '<div>';
                echo '<a id="eventOptionLink" data-bs-toggle="modal" data-bs-target="#eventOptionsModal"></a>';
            echo '</div>';
        }

        echo "<nav class='navbar navbar-light'>";
            echo "<div class='container-fluid mb-4'>";
                $action = base_url('events');
                echo "<form class='d-flex' action=" . $action . " method='post'>";
                    echo "<input class='form-control me-2 form-cookmaster' type='search' placeholder='".lang('Common.searchEventsExemple')."' aria-label='Search' name='search'>";
                        echo form_submit('', lang('Common.search'), 'class="btn blue-btn form-control"');
                echo "</form>";
            echo "</div>";
        echo "</nav>";

        echo "<div class='row grid-events' id='event-container'>"; //MAKE IT A GRID

        if (isset($events) && is_array($events) && count($events) > 0){
            $ads = 0;
            foreach ($events as $event){
                if ($event->isprivate == 1) {
                    if (!isContractor() && !isManager()){
                        $participation = callAPI('/event/participation/' . $event->idevent, 'get');
                        if (isset($participation) && !empty($participation)){
                            continue;
                        }
                    }
                }
                $ads++;

                $subscription = getSubscription();
                #DISPLAY ADS
                if (!isContractor() && !isManager()){
                     if ((isset($subscription) && $subscription['price'] == 0) || !isLoggedIn()) {
                         if (($ads % 5) == 0) {
                            $ad = rand(1, 2);
                             echo "<div class='col mb-3'>";
                             echo "<div class='ad-container'>";
                             echo "<a href=" . base_url("checkout?subscription=3") ." class='mb-5'><img src=" . base_url("assets/images/ads/" . $ad . ".png") . " alt='Sample Ad' /></a>";
                             echo "</div>";
                             echo "<div class='event-card-body-right'>";
                             echo "</div>";
                             echo "</div>";
                         }
                     }
                }   

                // Print the private events
                if ($event->isinternal == 1) {
                    if (!isContractor() && !isManager()){
                        if ((isset($subscription) && $subscription['price'] == 0) || !isLoggedIn()) {
                            echo "<div class='event-card col mb-3'>";
                            if (!isLoggedIn()){
                                $redirection = base_url("signIn");
                            } else {
                                $redirection = base_url("subscriptions");
                            }

                            if ($event->ideventgroups != 1) {
                                $color = "card-suggestion-event-red";
                            } else {
                                $color = "card-suggestion-event-blue";
                            }
                            echo "<a href=".$redirection." class='" . $color ."'>";
                                echo "<div class='event-card-header'>";
                                    echo "<h2>".lang('Common.privateEvent')."</h2>";
                                echo "</div>";
                                echo "<img alt='event picture' class='card-img-top' height='200vh' src=" . base_url("assets/images/svg/lock-icon-blue.svg") . " />";
                                echo "<div class='card mb-5'>";
                                    echo "<div class='card-body'>";
                                        echo "<p class='card-text'>".lang('Common.subscribeToJoin')."</p>";
                                    echo "</div>";
                                    echo "<div class='event-card-body-right'>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</a>";
                        echo "</div>";
                        continue;   
                        }
                    }
                }

                echo "<div class='event-card col mb-5'>";
                    if (!isLoggedIn()){
                        $redirection = base_url("signIn");
                    } else {
                        $redirection = base_url("event/" . $event->idevent);
                    }
                    if ($event->ideventgroups != 1) {
                        $color = "card-suggestion-event-red";
                    } else {
                        $color = "card-suggestion-event-blue";
                    }
                    echo "<a href=".$redirection." class='" . $color . "'>";
                    echo "<div class='event-card-header'>";
                        echo "<h2>" . $event->name . "</h2>";
                    echo "</div>";
                    echo "<div class='card mb-3'>";
                    echo "<img alt='event picture' class='card-img-top' height='250vh' src=" . base_url("assets/images/events/" . $event->defaultpicture) . " />";
                        echo "<div class='card-body'>";
                            $date['start'] = $event->starttime;
                            $date['start'] = date("d/m/Y H:i:s", strtotime($date['start']));
                            echo "<p class='card-text'>". lang('Common.startsOn'). $date['start'] . "</p>";
                            echo "<p class='card-text'>". lang('Common.type'). ' : ' . $event->type . "</p>";
                            $cookingspace['space'] = callAPI('/event/host/' . $event->idevent, 'get');
                            if (isset($cookingspace['space']) && $cookingspace['space']['error'] != true){
                                echo "<p class='card-text'>" . lang('Common.takesPlaceAt') . $cookingspace['space']['cookingspaces'][0]->name . "</p>";
                            } else {
                                echo "<p class='card-text'>Hosted in: To be defind</p>";
                            }
                            // TO DO : ADD REAL ADS
                        echo "</div>";
                        echo "<div class='event-card-body-right'>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            echo "<p>There are no events plans yet.</p>";
        }
        echo "</div>";

        if (!isset($search)) {
                echo "<nav aria-label='Page navigation example'>";
                    echo "<ul class='pagination'>";
                        echo "<li class='page-item'>";
                        $page = isset($_GET['page']) ? $_GET['page'] : 1;
                        $before = $page == 1 ? 1 : $page-1;
                        $after = $page == $totalPages ? $totalPages : $page+1;
                                echo "<a class='page-link' href='" . base_url("events?page=" . $before . "") . "' aria-label='Previous'>";
                                echo "<span aria-hidden='true'>&laquo;</span>";
                            echo "</a>";
                        echo "</li>";
                        for ($i = 1; $i <= $totalPages; $i++) {
                            echo "<li class='page-item'><a class='page-link pagination-link' href='" . base_url("events?page=" . $i . "") . "' data-page='" . $i . "'>" . $i . "</a></li>";
                        }
                            echo "<a class='page-link' href='" . base_url("events?page=" . $after . "") . "' aria-label='Next'>";
                                echo "<span aria-hidden='true'>&raquo;</span>";
                            echo "</a>";
                        echo "</li>";
                    echo "</ul>";
                echo "</nav>";
        }

        echo "</div>";

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5567240416427109"
     crossorigin="anonymous"></script>
</html>

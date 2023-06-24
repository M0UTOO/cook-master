<?php

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h1 class='mb-5'>" . $title . "<img alt='logo' class='' src=" . base_url("assets/images/svg/moon-icon.svg") . " /></h1>";


        if (isManager()){
            echo $this->include('event/eventOptionsModal') ;
            echo '<div>';
                echo '<a id="eventOptionLink" data-bs-toggle="modal" data-bs-target="#eventOptionsModal"></a>';
            echo '</div>';
        }

        echo "<div class='row grid-events' id='event-container'>"; //MAKE IT A GRID

        if (isset($events) && is_array($events) && count($events) > 0){
            $ads = 0;
            foreach ($events as $event){
                if ($event->isclosed == 1){
                    continue;
                }
                if ($event->isprivate == 1) {
                    if (!isContractor() && !isManager()){
                        $participation = callAPI('/event/participation/' . $event->idevent, 'get');
                        if (isset($participation) && !empty($participation)){
                            continue;
                        }
                    }
                }
                $ads++;

                // CHECK ONCE SUBSCRIPTIONS ARE IMPLEMENTED
                $subscrition = getSubscription();
                if (!isContractor() && !isManager()){//&& $subscrition['price'] == 0){
                    if (($ads % 3) == 0){
                        echo "<div class='event-card col mb-3'>";
                            echo "<div class='card-suggestion-event'>";
                                echo "<div class='event-card-header'>";
                                    echo "<h2>AD</h2>";
                                echo "</div>";
                                echo "<div class='card mb-5'>";
                                    echo "<img alt='event picture' class='card-img-top' height='200vh' src=" . base_url("assets/images/events/ads.jpg") . " />";
                                    echo "<div class='card-body'>";
                                        echo "<p class='card-text'>This is an ad</p>";
                                    echo "</div>";
                                    echo "<div class='event-card-body-right'>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                }   

                if ($event->isinternal == 1) {
                    if (isContractor() && isManager() ){//&& $subscrition['price'] != 0){
                        continue;
                    } else {
                        echo "<div class='event-card col mb-3'>";
                            if (!isLoggedIn()){
                                $redirection = base_url("signIn");
                            } else {
                                $redirection = base_url("subscriptions");
                            }
                            echo "<a href=".$redirection." class='card-suggestion-event'>";
                                echo "<div class='event-card-header'>";
                                    echo "<h2>Private Event</h2>";
                                echo "</div>";
                                echo "<img alt='event picture' class='card-img-top' height='200vh' src=" . base_url("assets/images/svg/lock-icon-blue.svg") . " />";
                                echo "<div class='card mb-5'>";
                                    echo "<div class='card-body'>";
                                        echo "<p class='card-text'>Subscribe to join event</p>";
                                    echo "</div>";
                                    echo "<div class='event-card-body-right'>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</a>";
                        echo "</div>";
                    }
                }

                echo "<div class='event-card col mb-5'>";
                    if (!isLoggedIn()){
                        $redirection = base_url("signIn");
                    } else {
                        $redirection = base_url("event/" . $event->idevent);
                    }
                    echo "<a href=".$redirection." class='card-suggestion-event'>";
                    echo "<div class='event-card-header'>";
                        echo "<h2>" . $event->name . "</h2>";
                    echo "</div>";
                    echo "<div class='card mb-3'>";
                    echo "<img alt='event picture' class='card-img-top' height='250vh' src=" . base_url("assets/images/events/" . $event->defaultpicture) . " />";
                        echo "<div class='card-body'>";
                            $date['start'] = $event->starttime;
                            $date['start'] = date("d/m/Y H:i:s", strtotime($date['start']));
                            echo "<p class='card-text'>Starts at: " . $date['start'] . "</p>";
                            $cookingspace['space'] = callAPI('/event/host/' . $event->idevent, 'get');
                            if (isset($cookingspace['space'])){
                                echo "<p class='card-text'>Hosted in: " . $cookingspace['space'][0]->name . "</p>";
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

        echo "</div>";

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
<script>
    function displayEvents(page) {

    $.ajax({
        url: 'index.php',
        type: 'GET',
        data: { page: page },
        success: function (response) {
            $('#event-container').html(response);
        },
        error: function (error) {
            console.log(error);
        }
    });
    }

    // Handle pagination link clicks
    $('.pagination-link').on('click', function (event) {
        event.preventDefault();
        const page = $(this).data('page'); // Get the page number from the data attribute
        displayEvents(page);
    });

    // Initially display the events for the first page
    displayEvents(1);
</script>
</html>

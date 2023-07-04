<?php

echo $this->include('layouts/head') ;


    echo '<body>';
    echo $this->include('layouts/header') ;
    helper('form');

    echo "<h1 class='mb-3'>" . $title . "<img alt='logo' class='' src=" . base_url("assets/images/svg/moon-icon.svg") . " /></h1>";

        if (getCurrentUserId() != $idcontractor){
            echo "<p>You are not allowed to access this page.</p>";
            return;
        }


        if (isManager() || isContractor()){
            echo $this->include('event/eventOptionsModal') ;
            echo '<div>';
                echo '<a id="eventOptionLink" data-bs-toggle="modal" data-bs-target="#eventOptionsModal"></a>';
            echo '</div>';
        }

        echo "<div class='row grid-events' id='event-container'>"; //MAKE IT A GRID

        if (isset($events) && is_array($events) && count($events) > 0){
            foreach ($events as $event){
                if ($event->isprivate == 1) {
                    if (!isContractor() && !isManager()){
                        $participation = callAPI('/event/participation/' . $event->idevent, 'get');
                        if (isset($participation) && !empty($participation)){
                            continue;
                        }
                    }
                }

                echo "<div class='event-card col mb-5'>";
                    if ($event->isclosed == 1){
                        $redirection = base_url("event/" . $event->idevent);
                    } else {
                        $redirection = base_url("eventContractor/validate/" . $event->idevent);
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
                            echo "<p class='card-text'>Starts at: " . $date['start'] . "</p>";
                            $cookingspace['space'] = callAPI('/event/host/' . $event->idevent, 'get');
                            if (isset($cookingspace['space']) && !empty($cookingspace['space'][0]->name)){
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
        echo "</div>";

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
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5567240416427109"
     crossorigin="anonymous"></script>
</html>

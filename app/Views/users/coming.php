<?php

echo $this->include('layouts/head') ;


    echo '<body>';
    echo $this->include('layouts/header') ;
    helper('form');

    echo "<h1 class='mb-3'>" . $title . " :</h1>";

        echo "<div class='row grid-events' id='event-container'>"; //MAKE IT A GRID

        if (isset($events) && is_array($events) && count($events) > 0){
            $ads = 0;
            foreach ($events as $event){
                $ads++;

                $subscrition = getSubscription();
                if (!isContractor() && !isManager() && $subscrition['price'] == 0){
                    if (($ads % 5) == 0){
                        echo "<div class='event-card col mb-3'>";
                            echo "<div class='card-suggestion-event-blue'>";
                                echo "<div class='card mb-5'>";
                                    echo "<div class='ad-container'>";
                                        echo "<img src='https://via.placeholder.com/300x440' alt='Sample Ad' />";
                                    echo "</div>";
                                    echo "<div class='event-card-body-right'>";
                                    echo "</div>";
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    }
                }   

                echo "<div class='event-card col mb-5'>";
                    if (!isLoggedIn()){
                        $redirection = base_url("signIn");
                    } else {
                        $redirection = base_url("event/" . $event->idevent);
                    }
                    echo "<a href=".$redirection." class='card-suggestion-event-blue'>";
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
                        echo "</div>";
                        echo "<div class='event-card-body-right'>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "</a>";
            }
        } else {
            if ($title == lang('Common.comingEvents')) {
                echo "<p>" . lang('Common.noComingEvents') . "</p>";
            } else {
                echo "<p>" . lang('Common.noPastEvents') . "</p>";
            }
        }
        echo "</div>";

        echo "</div>";

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5567240416427109"
     crossorigin="anonymous"></script>
</html>

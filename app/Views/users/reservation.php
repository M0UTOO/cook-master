<?php

echo $this->include('layouts/head') ;


    echo '<body>';
    echo $this->include('layouts/header') ;
    helper('form');

    echo "<h1 class='mb-3'>" . $title . " :</h1>";

        echo "<div class='row grid-events' id='event-container'>"; //MAKE IT A GRID

        if (isset($reservations) && is_array($reservations) && count($reservations) > 0){
            $ads = 0;
            foreach ($reservations as $reservation){
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
                        $redirection = base_url("cookingSpace/" . $reservation->idcookingspace);
                    }
                    echo "<a href=".$redirection." class='card-suggestion-event-blue'>";
                    echo "<div class='event-card-header'>";
                        echo "<h2>" . $reservation->name . "</h2>";
                    echo "</div>";
                    echo "<div class='card mb-3'>";
                    echo "<img alt='event picture' class='card-img-top' height='250vh' src=" . base_url("assets/images/cookingSpaces/" . $reservation->picture) . " />";
                        echo "<div class='card-body'>";
                            $date['start'] = $reservation->starttime;
                            $date['end'] = $reservation->endtime;
                            $date['start'] = date("d/m/Y H:i:s", strtotime($date['start']));
                            $date['end'] = date("d/m/Y H:i:s", strtotime($date['end']));
                            echo "<p class='card-text'>" . lang('Common.hasStarted') . "" . $date['start'] . "</p>";
                            echo "<p class='card-text'>" . lang('Common.hasEnded') . "" . $date['end'] . "</p>";
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

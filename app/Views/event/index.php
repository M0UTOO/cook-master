<?php

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "<img alt='logo' class='' src=" . base_url("assets/images/svg/moon-icon.svg") . " /></h2>";


        if (isManager()){
            echo $this->include('event/eventOptionsModal') ;
            echo '<div>';
                echo '<a id="eventOptionLink" data-bs-toggle="modal" data-bs-target="#eventOptionsModal"></a>';
            echo '</div>';
        }

        echo "<section id='all-events'>"; //MAKE IT A GRID

        if (isset($events) && is_array($events) && count($events) > 0){
            foreach ($events as $event){
                echo "<div class='event-card col-sm-3' >";
                //FORMAT OF EVENT CARDS
                echo "<h3>";
                echo $event->name ;
                if (isManager()){
                    echo '<a href="/event/delete/' . $event->idevent . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                    echo '<a href="/event/edit/' . $event->idevent . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                }
                echo "</h3>";
                echo "<p>Welcome to Cookmaster, where we're passionate about making your culinary journey a deliciously unforgettable one</p>";
                echo "</div>";
            }
        } else {
            echo "<p>There are no events plans yet.</p>";
        }

        //TODO:ADD PAGINATION TO THIS SECTION (ALWAYS SHOW X EVENTS PER PAGE)

        echo "</section>";

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

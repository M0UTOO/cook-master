<?php
echo $this->include('layouts/head') ;

function displayDifficultyLevel( $difficulty )
{
    for ($i = 0; $i<$difficulty;$i++) {
        echo '<h3 class="me-2">⭐</h3>';
    }
}

$currentId = getCurrentUserId();
            $action = base_url('event/join');
            $verif = false;
            $verifContractor = false;
            foreach ($participation as $client) {
                if ($client->iduser == $currentId) {
                    $verif = true;
                }
            }
            foreach ($animate as $contractor) {
                if ($contractor->iduser == $currentId) {
                    $verifContractor = true;
                }
            }



echo '<body>';

    echo $this->include('layouts/header') ;

    helper('form');

    if ($event['isclosed'] == true){
        echo "<h1 class='mb-3'>" . lang('Common.closedEvent') . "</h1>";
        if (isset($rate)) {
            echo '<div class="d-flex flex-row">';
            if (isset($comments) && is_array($comments) && count($comments) > 0) {
                echo '<h3 class="me-2">' . lang('Common.rate') . ' : </h3>';
                displayDifficultyLevel($rate['grade']);
                echo '<h3 class="me-2">/5</h3>';
            } else {
                echo '<h3 class="me-2">' . lang('Common.noRate') . '</h3>';
            }
            echo "</div>";
        } else {
            echo "<h2 class='mb-3'>" . lang('Common.noRate') . "</h2>";
        }
    }


    echo '<div class="ad-spot" style="min-height: 5rem; min-width: 50vw;background-color: var(--placeholder-color);">ADD SPOT</div>';

    echo "<section id='lesson-info d-flex' style='min-width: 100%'>";
        if (isset($event)){

            echo "<div class='lesson-card d-flex flex-column'>";
            if (isManager() || $verifContractor == true){
                echo '<div class="">';
                echo '<a class="me-3" href="/event/delete/' . $event["idevent"] . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '<a class="me-3" href="/eventGroup/delete/' . $event["idevent"] . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '<a href="/event/edit/' . $event["idevent"] . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '</div>';
            }

            echo '<div class="d-flex flex-rows event-info mt-4">';
                echo '<div>';
                    echo '<div>';
                        echo "<h1>";
                            echo $event['name'] ;
                        echo "</h1>";
                    echo '</div>';

                    echo '<div class="mt-4">';
                        echo "<h2>";
                            echo $event['description'] ;
                        echo "</h2>";
                    echo '</div>';
                echo '</div>';

                echo '<div class="event-image">';
                    echo "<h3>";
                        echo "<img alt='event picture' class='' height='400em' width='400em' src=" . base_url("assets/images/events/" . $event['defaultpicture']) . " />";
                    echo "</h3>";
                    echo '<div>';
                        echo "<h3>";
                            $date['start'] = $event['starttime'];
                            $date['start'] = date("d/m/Y H:i:s", strtotime($date['start']));
                            echo "<h3>" . lang('Common.startsOn') . "" . $date['start'] . "</h3>";
                        echo "</h3>";
                    echo '</div>';
                    echo '<div>';
                    echo '<div class="event-host">';
                        echo "<h4 style='margin-right: 5px;'>" . lang('Common.takesPlaceAt') . "</h4>";
                        if (isset($space) && !empty($space[0]->name)){
                                echo "<h4>" . $space[0]->name . "</h4>";
                                if (isManager() || $verifContractor == true){
                                    echo '<a class="mr-3" href="/eventSpace/delete/' . $event["idevent"] . '/' . $space[0]->idcookingspace .'"><img src="http://localhost:8080/assets/images/svg/trash-icon-red.svg" alt="delete-icon" class="icons" style="margin-left: 5px;margin-bottom: 4px;"></a>';
                                }
                        } else {
                            echo "<h4>" . lang('Common.toBeDefined') . "</h4>";
                        }   
                        echo '</div>';
                    echo '</div>';
                    echo '<div>';
                        echo "<h3>" . lang('Common.hostedBy') . "</h3>";
                        if (isset($animate) && !empty($animate)) {
                            foreach($animate as $contractor){
                                $info = callAPI('/contractor/'.$contractor->idcontractor, 'get');
                                echo '<div class="d-flex" style="justify-content: space-between;">';
                                    echo "<h5>" . $info['firstname'] . " " . $info['lastname'] . "</h5>";
                                    if (isManager() || $verifContractor == true){
                                        echo '<a class="ml-3" href="/eventContractor/delete/' . $event["idevent"] . '/' . $contractor->idcontractor . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                                    }
                                    echo '</div>';
                            }
                        } else {
                            echo "<h5>" . lang('Common.toBeDefined') . "</h5>";
                        }
                    echo '</div>';
                echo '</div>';
            echo '</div>';

        }

        echo "<div>";

        if (isClient() && $event['isclosed'] == 0) {
            if ($verif == false) {
                $action = base_url('event/join');
            } else {
                $action = base_url('event/leave');
            }

            echo "<div class='container-fluid mb-4'>";
                echo "<form class='d-flex' action=" . $action . " method='post'>";
                echo form_hidden('iduser', $currentId);
                echo form_hidden('idevent', $event['idevent']);
                    if ($verif == false) {
                            echo form_submit('', 'Join Event', 'class="btn blue-btn form-control"');
                    } else {
                            echo form_submit('', 'Leave Event', 'class="btn red-btn form-control"');
                    }
                echo "</form>";
            echo "</div>";
        }

        if (isset($participation) && is_array($participation) && count($participation) > 0){
            echo '<section class="table-responsive">';
                echo '<table class="table">';
        
                    echo '<thead>';
                        echo '<tr>';
                            echo '<th scope="col">' . lang('Common.participations') . '</th>';
                        echo '</tr>';
                    echo '</thead>';
        
                    echo '<tbody class="table-group-divider">';
        
        
                            foreach ($participation as $client){
                                $redirection = base_url("/profile/".$client->iduser);
                                echo '<tr id="row-clickable-client" data-href='.$redirection.'>';
                                echo "<td>$client->firstname $client->lastname</td>";
                                echo '</tr>';
                            }
            echo "</tbody>";
            echo "</table>";
            echo "</section>";
                        } else {
                            echo "<p>" . lang('Common.noParticipations') . "</p>";
                        }
            echo "</div>";
            
            echo "<section id='other-lessons'>";
            if (isset($eventGroup)){
            echo "<h2 class='title-suggestion-event'>" . lang('Common.otherEvent') . " " . $group[0]->name . " :</h2>";
            echo "<div class='lesson-suggestion flex-rows'>";
                foreach ($eventGroup as $suggestedEvent){
                    if ($suggestedEvent->idevent != $event['idevent']){
                        echo "<div class='event-card col mb-5'>";
                        if (!isLoggedIn()){
                            $redirection = base_url("signIn");
                        } else {
                            $redirection = base_url("event/" . $suggestedEvent->idevent);
                        }
                        if ($suggestedEvent->ideventgroups != 1) {
                            $color = "card-suggestion-event-red";
                        } else {
                            $color = "card-suggestion-event-blue";
                        }
                        echo "<a href=".$redirection." class='" . $color . "'>";
                        echo "<div class='event-card-header'>";
                            echo "<h2>" . $suggestedEvent->name . "</h2>";
                        echo "</div>";
                        echo "<div class='card mb-3'>";
                        echo "<img alt='event picture' class='card-img-top' height='250vh' src=" . base_url("assets/images/events/" . $suggestedEvent->defaultpicture) . " />";
                            echo "<div class='card-body'>";
                                $date['start'] = $suggestedEvent->starttime;
                                $date['start'] = date("d/m/Y H:i:s", strtotime($date['start']));
                                echo "<p class='card-text'>" . lang('Common.startsOn') . " " . $date['start'] . "</p>";
                                $cookingspace['space'] = callAPI('/event/host/' . $suggestedEvent->idevent, 'get');
                                if (isset($cookingspace['space']) && !empty($cookingspace['space'][0]->name)){
                                    echo "<p class='card-text'>" . lang('Common.hostedBy') . " " . $cookingspace['space'][0]->name . "</p>";
                                } else {
                                    echo "<p class='card-text'>" . lang('Common.hostedBy') . ": " . lang('Common.toBeDefined') . "</p>";
                                }
                            echo "</div>";
                            echo "<div class='event-card-body-right'>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";
                    echo "</a>";
                }
            }
            echo "</div>";
            echo "</div>";
            }

            if ($event['isclosed'] == true) {
                if (isset($comments) && is_array($comments) && count($comments) > 0) {
                    echo '<h1 class="mt-4" style="justify-content: center;display: flex;">' . lang('Common.comments') . ' :</h1>';
                } else {
                    echo '<h1 class="mt-4" style="justify-content: center;display: flex;">' . lang('Common.noCommentsYet') . '</h1>';
                }
            }

            if ($event['isclosed'] == true) {
                if ($verif == true) {
                    echo '<div class="mb-4">';
                        echo '<a href="/comment/create/' . $event['idevent'] . '" id="eventOptionLink"></a>';
                    echo '</div>';
                }
                foreach ($comments as $comment) {
                    echo '<div class="comment-container mb-4">';
                        echo '<div class="comment-header">';
                            echo '<div class="comment-user d-flex flex-row">';
                                echo '<div class="comment-user-image me-2">';
                                    echo "<img alt='user picture' class='' height='50em' width='50em' src=" . base_url("assets/images/users/" . $comment->picture) . " />";
                                echo '</div>';
                                echo '<div class="comment-user-name d-flex flex-row">';
                                    echo "<h3 class='me-2'>" . $comment->firstname . " " . $comment->lastname . " :</h3>";
                                    displayDifficultyLevel($comment->grade);
                                echo '</div>';
                                if ($comment->iduser == $currentId) {
                                    echo '<div class="d-flex flex-row">';
                                        echo '<a class="me-3" href="/comment/delete/' . $comment->idcomment . '/0"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                                        echo '<a href="/comment/edit/' . $comment->idcomment . '/0"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                                    echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="comment-body">';
                            echo "<h3>" . $comment->content . "</h3>";
                        echo '</div>';
                        if ($comment->picture != "default.png") {
                            echo '<div class="comment-picture">';
                                echo "<img alt='' class='' height='400em' width='400em' src=" . base_url("assets/images/comments/" . $comment->picture) . " />";
                            echo '</div>';
                        }
                    echo '</div>';
                }
            }

        echo "</div>";
        
        echo "</section>";

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

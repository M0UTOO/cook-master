<?php

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h1>Event : " . $event['name'] . "</h1>";

    echo "<h2>" . $title . "<img alt='logo' class='img-participation' src=" . base_url("assets/images/svg/appel-icon.svg") . " /></h2>";

    $currentId = getCurrentUserId();
    $verifContractor = false;
    foreach ($animate as $contractor) {
        if ($contractor->iduser == $currentId) {
            $verifContractor = true;
        }
    }

    if ($verifContractor == false) {
        echo "<p>You are not allowed to access this page.</p>";
        return;
    }

if (isset($clients) && is_array($clients) && count($clients) > 0){
    echo '<section>';
        echo '<table class="table">';

            echo '<thead>';
                echo '<tr>';
                    echo '<th scope="col">Name</th>';
                    echo '<th scope="col">Email</th>';
                    echo '<th scope="col">Actions</th>';
                echo '</tr>';
            echo '</thead>';

            echo '<tbody class="table-group-divider">';


                    foreach ($clients as $client){
                        echo "<tr class='no-pointer'>";
                        echo "<td>$client->firstname $client->lastname</td>";
                        echo "<td>$client->email</td>";
                        $ispresent = callAPI('/event/ispresent/' . $event['idevent'] . '/' . $client->idclient, 'get');
                        if (isset($ispresent) && !empty($ispresent)){
                            if ($ispresent['ispresent'] == 1) {
                                echo "<td>";
                                    echo '<a href="/eventContractor/removeParticipant/' . $event['idevent'] . '/' . $client->iduser . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                                echo "</td>";
                            } else {
                                echo "<td>";
                                    echo '<a href="/eventContractor/addParticipant/' . $event['idevent'] . '/' . $client->iduser . '"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="add-icon" class="icons" /></a>';
                                echo "</td>";
                            }
                        } else {
                            echo "<td>";
                            echo "</td>";
                        }
                        echo "</tr>";
                    }
    echo "</tbody>";
    echo "</table>";
    echo "<div class='d-flex justify-content-center'>";
    echo '<a href="/event/close/' . $event['idevent'] . '"><button type="button" class="btn btn-lg btn-closed-event">Close Event</button></a>';
    echo "</div>";
    echo "</section>";
                } else {
                    echo "<p>There are no participants.</p>";
                }

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>

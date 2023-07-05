<?php
echo "<section>";
    echo "<h2>Incoming reservations</h2>";

        if (isManager()){
            //CREATE A RESERVATION FOR A CLIENT ?  LINK THE ROOM TO AN EVENT.
            echo '<a href="/cookingSpace/create"><img src=' . base_url("assets/images/svg/add-circle-icon.svg") . ' alt="plus-icon" class="icons" /></a>';
        }

if (isset($reservations) && is_array($reservations) && count($reservations) > 0) {

    echo '<section class="table-responsive">';
    echo '<table class="table">';

    echo '<thead>';
    echo '<tr>';
    echo '<th class="text-nowrap" scope="col">From</th>';
    echo '<th class="text-nowrap" scope="col">To</th>';
    echo '<th class="text-nowrap" scope="col">By</th>';

    if (isManager()) {
        echo '<th scope="col">Actions</th>';
        //can cancel a reservation ?
    }
    echo '</tr>';
    echo '</thead>';

    echo '<tbody class="table-group-divider">';

    foreach ($reservations as $reservation){
        echo "<tr>";
            echo "<td>".$reservation['starttime']."</td>";
            echo "<td class='text-center'>".$reservation['endtime']." </td>";
            echo "<td class='text-center'>".$reservation['iduser']." </td>";

            if (isManager()) {
                echo "<td>";
                echo '<a href="/cookingSpace/delete/' . $reservation['idCookingSpace'] . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons ms-3" /></a>';
                echo "</td>";
            }
        }
        echo '</tr>';

        echo "</tbody>";
        echo "</table>";
        echo '</section>';
    }
    else {
        echo '<p>No cooking spaces reservations found</p>';
    }


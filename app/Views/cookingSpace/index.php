<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "</h2>";

if (isset($cookingSpaces) && is_array($cookingSpaces) && count($cookingSpaces) > 0) {

//    echo '<section class="table-responsive">';
//    echo '<table class="table">';
//
//    echo '<thead>';
//    echo '<tr>';
//    echo '<th scope="col">Name</th>';
//    echo '<th class="text-nowrap" scope="col">Room capacity</th>';
//    echo '<th class="text-nowrap" scope="col">Current state</th>';
//    echo '<th class="text-nowrap" scope="col">Price per hour (€)</th>';
//if (isManager()) {
//    echo '<th scope="col">Actions</th>';
//}
//    echo '</tr>';
//    echo '</thead>';
//
//    echo '<tbody class="table-group-divider">';
//
//    foreach ($cookingSpaces as $cookingSpace){
//        $redirection = base_url("/cookingSpace/edit/".$cookingSpace->idCookingSpace);
//
//            echo '<tr id="row-clickable-client" data-href='.$redirection.'>';
//            echo "<td>$cookingSpace->name</td>";
//            echo "<td class='text-center'>$cookingSpace->size </td>";
//
//            if ($cookingSpace->isAvailable == 1){
//                echo "<td class='text-center'>available</td>";
//            } else {
//                echo "<td class='text-center table-danger'>unavailable</td>";
//            }
//            echo "<td class='text-center'>$cookingSpace->pricePerHour </td>";
//
//            if (isManager()) {
//                echo "<td>";
//                echo '<a href="/cookingSpace/delete/' . $cookingSpace->idPremise . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons ms-3" /></a>';
//                echo '<a href="/cookingSpace/edit/' . $cookingSpace->idPremise . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons ms-1" /></a>';
//                echo "</td>";
//            }
//        }
//        echo '</tr>';
//
//        echo "</tbody>";
//        echo "</table>";
//        echo '</section>';
 foreach ($cookingSpaces as $cookingSpace){
      echo "<div class='event-card col mb-5'>";
                    if (!isLoggedIn()){
                        $redirection = base_url("signIn");
                    } else {
                        $redirection = base_url("cookingSpace/" . $cookingSpace->idCookingSpace);
                    }
                    echo "<a href=".$redirection." class='card-suggestion-event'>";
                    echo "<div class='event-card-header'>";
                        echo "<h2>" . $cookingSpace->name . "</h2>";
                    echo "</div>";
                    echo "<div class='card mb-3'>";
                    echo "<img alt='event picture' class='card-img-top' height='250vh' src=" . base_url("assets/images/cookingSpaces/default.png") . " />";
                        echo "<div class='card-body'>";

                        echo "</div>";
                        echo "<div class='event-card-body-right'>";
                        echo "</div>";
                    echo "</div>";
                echo "</div>";
                echo "</a>";
    }
} else
    {
    echo "<p>There are no premises yet.</p>";
    }

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>


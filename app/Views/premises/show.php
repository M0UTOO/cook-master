<?php
echo $this->include('layouts/head') ;

echo '<body>';
echo $this->include('layouts/header') ;

echo "<section id='focus-premise'>";
    if (isset($premise)){

        echo "<div class='subscription-card'>";
        echo "<h3 class='d-flex justify-content-center'>";
        echo $premise['name'] ;
        if (isManager()){
            echo '<a href="/premise/delete/' . $premise["idPremise"] . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons ms-5" /></a>';
            echo '<a href="/premise/edit/' . $premise["idPremise"] . '"><img src=' . base_url("assets/images/svg/edit-icon.svg") . ' alt="modify-icon" class="icons ms-3" /></a>';
            echo "</h3>";
            echo "<p>Location: " . $premise['streetNumber'] . " " . $premise['streetName']  . " - " . $premise['city'] ."</p>";
            echo "</div>";
        }
    }
echo "</section>";

    //Cookingspaces-list-tables
echo "<section id='room-in-premise'>";
if (isset($premise)) {
    if (isset($cookingSpaces) && is_array($cookingSpaces) && count($cookingSpaces) > 0) {
        echo "<h3>Cooking spaces in this premise<a class='ms-4' href='/cookingSpace/create'><img src=" . base_url("assets/images/svg/add-circle-icon.svg") . " alt='plus-icon' class='icons' /></a>" ."</h3>";
        echo '<section class="table-responsive">';
        echo '<table class="table">';

        echo '<thead>';
        echo '<tr>';
        echo '<th scope="col">Name</th>';
        echo '<th class="text-nowrap" scope="col">Room capacity</th>';
        echo '<th class="text-nowrap" scope="col">Current state</th>';
        echo '<th class="text-nowrap" scope="col">Price per hour (€)</th>';
        echo '<th scope="col">Actions</th>';
        echo '</tr>';
        echo '</thead>';

        echo '<tbody class="table-group-divider">';

        foreach ($cookingSpaces as $cookingSpace){
            $redirection = base_url("/cookingSpace/edit/".$cookingSpace->idCookingSpace);

            if (isManager()){

                echo '<tr id="row-clickable-client" data-href='.$redirection.'>';
                echo "<td>$cookingSpace->name</td>";
                echo "<td class='text-center'>$cookingSpace->size </td>";

                if ($cookingSpace->isAvailable == 1){
                    echo "<td class='text-center'>available</td>";
                } else {
                    echo "<td class='text-center table-danger'>unavailable</td>";
                }
                echo "<td class='text-center'>$cookingSpace->pricePerHour </td>";

                echo "<td>";
                echo '<a href="/cookingSpace/delete/' . $cookingSpace->idPremise . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons ms-3" /></a>';
                echo '<a href="/cookingSpace/edit/' . $cookingSpace->idPremise . '"><img src=' . base_url("assets/images/svg/edit-icon.svg") . ' alt="modify-icon" class="icons ms-1" /></a>';
                echo "</td>";
            }
            echo '</tr>';
        }
        echo "</tbody>";
        echo "</table>";
        echo '</section>';
    }
}
echo "</section>";
echo '</main>';
echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>

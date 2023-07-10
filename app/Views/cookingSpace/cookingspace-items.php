<?php
echo "<section class='includes-items'>";
echo "<h2 class='align-self-start mt-4'>".lang('Common.includedItems')."</h2>";

if (isset($items) && count($items) > 0) {

//table of items
    echo "<table class='table table-bordered '>";
    echo "<thead class='table-dark'>";
    echo "<tr>";
    echo "<th scope='col'>".lang('Common.item')."</th>";
    if (isManager()) {
        echo "<th scope='col'>".lang('Common.actions')."</th>";
    }
    echo "</tr>";
    echo "</thead>";

    echo "<tbody>";
// foreach ($items as $item){ display em and let managers remove them from the room or add new items.

    foreach ($items as $item) {
        echo "<tr>";
        echo "<td>" . $item['name'] . "</td>";

        if (isManager()) {
            echo "<td>";
            echo "<a href=" . base_url("item/delete/cookingspace/".$item['idcookingitem']) . " ><img src=".base_url("assets/images/svg/trash-icon-black.svg")."></a>";
            echo "</td>";
        }
        echo "</tr>";
    }
    echo "</tbody>";
    echo "</table>";

} else {
    echo "<p>".lang('Common.notFound.items')."</p>";
}
echo "</section>";

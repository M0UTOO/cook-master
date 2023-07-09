<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "</h2>";

    if (isManager()) {
        echo '<a href="/item/create"><img src=' . base_url("assets/images/svg/add-circle-icon.svg") . ' alt="plus-icon" class="icons" /></a>';

        if (isset($items) && is_array($items) && count($items) > 0) {
            echo '<section class="table-responsive">';
            echo '<table class="table">';

            echo '<thead>';
            echo '<tr id="no-cursor">';
            echo '<th scope="col">Name</th>';
            echo '<th scope="col">Status</th>';
            echo '<th scope="col">Cooking Space</th>';
            echo '<th scope="col">Actions</th>';
            echo '</tr>';
            echo '</thead>';

            echo '<tbody class="table-group-divider">';


            foreach ($items as $item) {

                echo '<tr id="no-cursor">';
                echo "<td>$item->name</td>";
                echo "<td>$item->status</td>";

                if ($item->idcookingspace == 1){
                    echo "<td>None</td>";
                    echo "<td>";
                    echo '<a href="/item/delete/' . $item->idcookingitem . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                    echo '<a href="/item/add/cookingspace/' . $item->idcookingitem . '"><img src=' . base_url("assets/images/svg/edit-icon.svg") . ' alt="modify-icon" class="icons ms-3" /></a>';
                } else {
                    $cookingspace = callAPI('/cookingitem/incookingspace/' . $item->idcookingitem, 'get');
                    echo "<td>" . $cookingspace[0]->name . "</td>";
                    echo "<td>";
                    echo '<a href="/item/delete/' . $item->idcookingitem . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                    echo '<a href="/item/delete/cookingspace/' . $item->idcookingitem . '"><img src=' . base_url("assets/images/svg/trash-icon-black.svg") . ' alt="delete-icon" class="icons ms-3" /></a>';
                }

                echo '<a href="/item/update/' . $item->idcookingitem . '"><img src=' . base_url("assets/images/svg/settings-icon-black.svg") . ' alt="delete-icon" class="icons ms-3" /></a>';

                echo "</td>";
                echo '</tr>';
            }
            echo "</tbody>";
            echo "</table>";
            echo "</section>";
        } else {
            echo "<p>There are no cooking items yet.</p>";
        }
    } else {
        echo "<p>You are not allowed to access this page.</p>";
    }
    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>


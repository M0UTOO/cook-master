<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "</h2>";

    if (isManager()) {
        echo '<a href="/ingredient/create"><img src=' . base_url("assets/images/svg/add-circle-icon.svg") . ' alt="plus-icon" class="icons" /></a>';

        if (isset($ingredients) && is_array($ingredients) && count($ingredients) > 0) {
            echo '<section class="table-responsive">';
            echo '<table class="table">';

            echo '<thead>';
            echo '<tr id="no-cursor">';
            echo '<th scope="col">Name</th>';
            echo '<th scope="col">Allergen</th>';
            echo '<th scope="col">Cooking Space</th>';
            echo '<th scope="col">Actions</th>';
            echo '</tr>';
            echo '</thead>';

            echo '<tbody class="table-group-divider">';


            foreach ($ingredients as $ingredient) {

                echo '<tr id="no-cursor">';
                echo "<td>$ingredient->name</td>";
                echo "<td>$ingredient->allergen</td>";

                if ($ingredient->idcookingspace == 1){
                    echo "<td>None</td>";
                    echo "<td>";
                    echo '<a href="/ingredient/delete/' . $ingredient->idingredient . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                    echo '<a href="/ingredient/add/cookingspace/' . $ingredient->idingredient . '"><img src=' . base_url("assets/images/svg/edit-icon.svg") . ' alt="modify-icon" class="icons ms-3" /></a>';
                    echo "</td>";
                } else {
                    $cookingspace = callAPI('/ingredient/incookingspace/' . $ingredient->idingredient, 'get');
                    echo "<td>" . $cookingspace[0]->name . "</td>";
                    echo "<td>";
                    echo '<a href="/ingredient/delete/' . $ingredient->idingredient . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                    echo '<a href="/ingredient/delete/cookingspace/' . $ingredient->idingredient . '"><img src=' . base_url("assets/images/svg/trash-icon-black.svg") . ' alt="delete-icon" class="icons ms-3" /></a>';
                    echo "</td>";
                }


                echo '</tr>';
            }
            echo "</tbody>";
            echo "</table>";
            echo "</section>";
        } else {
            echo "<p>There are no ingredients yet.</p>";
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


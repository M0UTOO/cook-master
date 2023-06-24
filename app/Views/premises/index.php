<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "</h2>";

        if (isManager()){
            echo '<a href="/premise/create"><img src=' . base_url("assets/images/svg/add-circle-icon.svg") . ' alt="plus-icon" class="icons" /></a>';
        }

if (isset($premises) && is_array($premises) && count($premises) > 0){
    echo '<section class="table-responsive">';
    echo '<table class="table">';

    echo '<thead>';
    echo '<tr>';
    echo '<th scope="col">Name</th>';
    echo '<th scope="col">Localization</th>';
    echo '<th scope="col">Actions</th>';
    echo '</tr>';
    echo '</thead>';

    echo '<tbody class="table-group-divider">';


    foreach ($premises as $premise){
        echo "<br>";
        $redirection = base_url("/premise/".$premise->idPremise);

        if (isManager()){

        echo '<tr id="row-clickable-client" data-href='.$redirection.'>';
        echo "<td>$premise->name</td>";
        echo "<td>$premise->streetNumber $premise->streetName $premise->city </td>";

        echo "<td>";
        echo '<a href="/premise/delete/' . $premise->idPremise . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
        echo '<a href="/premise/edit/' . $premise->idPremise . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
        echo "</td>";
        }
        echo '</tr>';
    }
    echo "</tbody>";
    echo "</table>";
    echo "</section>";
} else {
    echo "<p>There are no premises yet.</p>";
}

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>


<?= $this->include('layouts/head') ?>

<body>
<?= $this->include('layouts/header') ?>

<?php
if (isset($message)) {
    try {
        echo $message ;
    } catch (\Exception $e) {
        echo "Something went wrong. Please try again later.";
    }
}
echo '<a href="users/create"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="modify-icon" class="icons" /></a>';

?>

<!--THIS WHOLE SECTION IS ACTUALLY USERS/ALL SO SHOULD BE THE VIEW USERS/INDEX.PHP no ?-->
<section id="users-table">
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Firstname</th>
        <th scope="col">Lastname</th>
        <th scope="col">Role</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody class="table-group-divider">

    <?php
    $count = 0 ;

    if (isset($users)){
        //THIS CAN BE REFACTORED INTO A LOOP WITH A MAP.
        if (isset($managers)){
            foreach ($managers as $manager){
                $count +=1;
                echo "<tr>";
                echo "<th scope='row'>$count</th>";
                echo "<td>$manager->firstname</td>";
                echo "<td>$manager->lastname</td>";
                echo "<td>Manager</td>";
                echo '<td>TBH</td>';
                echo '<td>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/menu.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '</td>';
                echo "</tr>";
            }
        }
        if (isset($contractors)) {
            foreach ($contractors as $contractor) {
                $count += 1;
                echo "<tr>";
                echo "<th scope='row'>$count</th>";
                echo "<td>$contractor->firstname</td>";
                echo "<td>$contractor->lastname</td>";
                echo "<td>Contractor</td>";
                echo '<td>TBH</td>';
                echo '<td>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/menu.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '</td>';
                echo "</tr>";
            }
        }
        if (isset($clients)) {
            foreach ($clients as $client) {
                $count += 1;
                echo "<tr>";
                echo "<th scope='row'>$count</th>";
                echo "<td>$client->firstname</td>";
                echo "<td>$client->lastname</td>";
                echo "<td>Client</td>";
                echo '<td>TBH</td>';
                echo '<td>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/menu.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '</td>';
                echo "</tr>";
            }
        }
    } else {
    echo "There are no users.";
    }

    ?>

    </tbody>
</table>
</section>



</main>
<?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
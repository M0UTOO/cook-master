<?= $this->include('layouts/head') ?>

<body>
<?= $this->include('layouts/header') ?>

<?php
echo "<h2>Users Management</h2>";
if (isset($message)) {
    try {
        echo $message ;
    } catch (\Exception $e) {
        echo "Something went wrong. Please try again later.";
    }
}
echo '<a href="'. base_url('contractors/create').'"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="modify-icon" class="icons" /></a>';

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
        <th scope="col">Blocked_at</th>
        <th scope="col">Actions</th>
    </tr>
    </thead>
    <tbody class="table-group-divider">

    <?php
    $count = 0 ;

    if (isset($users)){

        //THIS CAN BE REFACTORED INTO A LOOP WITH A MAP.
        //TODO: ADD AN ICON TO BLOCK USER
        //TODO: ADD SEARCH BAR CHECK BOOTSTRAP DOCS
        if (isset($users["managers"]) && is_array($users["managers"])){
            foreach ($users["managers"] as $manager){
                $count +=1;
                if ($manager->issuperadmin) {
                    echo '<tr class="table-info">';
                } else {
                    echo "<tr>";
                }

                echo "<th scope='row'>$count</th>";
                echo "<td>$manager->firstname</td>";
                echo "<td>$manager->lastname</td>";
                echo "<td>Manager</td>";
                echo "<td>$manager->isblocked</td>";
                echo '<td>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-black.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '</td>';
                echo "</tr>";
            }
        }
        if (isset($users["clients"]) && is_array($users["clients"])){
            foreach ($users["clients"] as $client) {
                $count += 1;
                echo "<tr>";
                echo "<th scope='row'>$count</th>";
                echo "<td>$client->firstname</td>";
                echo "<td>$client->lastname</td>";
                echo "<td>Client</td>";
                echo "<td>$client->isblocked</td>";
                echo '<td>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-black.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '</td>';
                echo "</tr>";
            }
        }
       if (isset($users["contractors"]) && is_array($users["contractors"])){
            foreach ($users["contractors"] as $contractor) {
                $count += 1;
                echo "<tr>";
                echo "<th scope='row'>$count</th>";
                echo "<td>$contractor->firstname</td>";
                echo "<td>$contractor->lastname</td>";
                echo "<td>Contractor</td>";
                echo "<td>$contractor->isblocked</td>";
                echo '<td>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '<a href="#"><img src=' . base_url("assets/images/svg/trash-icon-black.svg") . ' alt="delete-icon" class="icons" /></a>';
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
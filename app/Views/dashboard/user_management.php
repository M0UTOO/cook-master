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
echo '<a data-bs-toggle="modal" data-bs-target="#userTypeModal"><img  src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="modify-icon" class="icons" /></a>';
echo $this->include("dashboard/chooseUserTypeModal.php");

//TODO: create some methods and css for the flashdata?
if (session()->getFlashdata('message')){
    echo '<div class="alert alert-info" role="alert">';
    echo session()->getFlashdata('message');
    echo '</div>';
}

?>

<!--THIS WHOLE SECTION IS ACTUALLY USERS/ALL SO SHOULD BE THE VIEW USERS/INDEX.PHP no ?-->
<section id="users-table" class="overflow-x:auto">
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

    function displayUsers($typeOfUser): void
    {
        echo "<td>$typeOfUser->isblocked</td>";
        echo '<td>';
        echo '<div class="d-flex justify-content-around">';
        echo '<a href="/users/delete/' . $typeOfUser->id . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
        echo '<a href="/users/block/' . $typeOfUser->id . '"><img src=' . base_url("assets/images/svg/trash-icon-black.svg") . ' alt="block-icon" class="icons" /></a>';
        echo '</div>';
        echo '</td>';
        echo "</tr>";
    }

    if (isset($users)){

        //THIS CAN BE REFACTORED INTO A LOOP WITH A MAP.
        //TODO: ADD AN ICON TO BLOCK USER
        //TODO: ADD SEARCH BAR CHECK BOOTSTRAP DOCS
        if (isset($users["managers"]) && is_array($users["managers"])){
            foreach ($users["managers"] as $manager){
                $count +=1;
                if ($manager->issuperadmin) {
                    //TODO: add clickable row to edit the user :NOT WORKING ATM
                    echo '<tr onclick="window.location='.base_url('/users/edit/'.$manager->id).'" class="table-info">';
                } else {
                    echo "<tr onclick='/users/edit'".$manager->id.">";
                }

                echo "<th scope='row'>$count</th>";
                echo "<td>$manager->firstname</td>";
                echo "<td>$manager->lastname</td>";
                echo "<td>Manager</td>";
                displayUsers($manager);
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
                displayUsers($client);
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
                displayUsers($contractor);
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
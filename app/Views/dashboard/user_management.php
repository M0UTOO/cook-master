<?= $this->include('layouts/head') ?>

<body>
<?= $this->include('layouts/header') ?>

<?php
echo "<h1>".lang('Common.userManagementTitle')."</h1>";

echo '<div>';
echo '<a data-bs-toggle="modal" data-bs-target="#userTypeModal"><img  src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="modify-icon" class="icons-medium me-3" /></a>';
echo $this->include("dashboard/chooseUserTypeModal.php");

echo '<a href="'.base_url('contractorTypes').'"><img  src=' . base_url("assets/images/svg/add-circle-icon.svg") . ' alt="modify-icon" class="icons-medium me-3" /></a>';
echo '</div>';
?>

<!--THIS WHOLE SECTION IS ACTUALLY USERS/ALL SO SHOULD BE THE VIEW USERS/INDEX.PHP no ? YES.-->
<section id="users-table" class="table-responsive">
<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col"><?=lang('Common.firstname')?></th>
        <th scope="col"><?=lang('Common.lastname')?></th>
        <th scope="col"><?=lang('Common.role')?></th>
        <th scope="col"><?=lang('Common.blocked_at')?></th>
        <th scope="col"><?=lang('Common.actions')?></th>
    </tr>
    </thead>
    <tbody class="table-group-divider">

    <?php
    $count = 0 ;

    function displayUsers($typeOfUser): void
    {
        //check user Type by checking if the user has a specific attribute
        if (isset($typeOfUser->isitemmanager)){
            $type = "Manager";
        } else if (isset($typeOfUser->contractortype)){
            $type = "Contractor";
        } else {
            $type = "Client";
        }

        echo "<td>$typeOfUser->isblocked</td>";
        echo '<td>';
        echo '<div class="d-flex justify-content-around">';
        echo '<a href="/users/delete/' . $typeOfUser->idusers . '/'. $type . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
        echo '<a href="/users/block/' . $typeOfUser->idusers . '"><img src=' . base_url("assets/images/svg/lock-icon-blue.svg") . ' alt="block-icon" class="icons" /></a>';
        echo '</div>';
        echo '</td>';
        echo "</tr>";
    }

    if (isset($users)){

        if (isset($users["managers"]) && is_array($users["managers"]) && count($users["managers"]) > 0){
            foreach ($users["managers"] as $manager){
                $count +=1;
                $redirection = base_url("/users/edit/".$manager->idusers);
                if ($manager->issuperadmin) {
                    echo '<tr class="table-info">';
                } else {
                    echo "<tr>";
                }

                echo "<th scope='row'>$count</th>";
                echo "<td>$manager->firstname</td>";
                echo "<td>$manager->lastname</td>";
                echo "<td>".lang('Common.userType.manager')."</td>";
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
                echo "<td>".lang('Common.userType.client')."</td>";
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
                echo "<td>".lang('Common.userType.contractor')."</td>";
                displayUsers($contractor);
            }
        }

    } else {
    echo lang('Common.notFound.users');
    }

    ?>

    </tbody>
</table>
</section>



</main>
<?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>
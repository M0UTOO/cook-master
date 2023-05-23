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
?>
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
    foreach ($users as $user){
        $count +=1;
        echo "<tr>";
        echo "<th scope='row'>$count</th>";
        echo "<td>$user->firstname</td>";
        echo "<td>$user->lastname</td>";
        //echo "<td>$user->role</td>"; if
        echo '<td>TBH</td>';
        echo '<td>';
        echo '<a href="#"><img src=' . base_url("assets/images/svg/menu.svg") . ' alt="modify-icon" class="icons" /></a>';
        echo '<a href="#"><img src=' . base_url("assets/images/svg/menu.svg") . ' alt="delete-icon" class="icons" /></a>';
        echo '</td>';
        echo "</tr>";
    }
    } else {
    echo "There are no users.";
    }

    ?>

    </tbody>
</table>




</main>
<?= $this->include('layouts/footer') ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
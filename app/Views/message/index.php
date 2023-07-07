<?php

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "<img alt='logo-lessons' class='ms-2 icons-medium' src=" . base_url("assets/images/svg/lessn-icon.svg") . " /></h2>";

if (isset($roles) && is_array($roles) && count($roles) > 0){
    echo '<section class="table-responsive">';
        echo '<table class="table">';

            echo '<thead>';
                echo '<tr>';
                    echo '<th scope="col">'.lang('Common.profile-picture').'</th>';
                    echo '<th scope="col">'.lang('Common.name').'</th>';
                echo '</tr>';
            echo '</thead>';

            echo '<tbody class="table-group-divider">';


                foreach ($roles as $role){
                    $redirection = base_url("/lesson/".$role->idcontractor);
                    if (isLoggedIn() && isClient()) {
                        echo '<tr id="row-clickable-client" data-href='.$redirection.'>';
                    } else {
                        //for others
                        echo "<tr data-href=".$redirection.">";
                    }
                    echo '<td><img src=' . base_url("assets/images/users/" . $role->profilepicture) . ' alt="profile_picture" class="icons-medium ms-3"/>';
                    echo '<td>' . $role->firstname . ' ' . $role->lastname . '</td>';
                    echo '</tr>';
                }
    echo "</tbody>";
    echo "</table>";
    echo "</section>";
                } else {
                    echo "<p>".lang('Common.notFound.lessons')."</p>";
                }

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>

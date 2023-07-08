<?php

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

if (isClient() || isManager()) {
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
                        $redirection = base_url("/message/".$role->idcontractor);
                        if ((isLoggedIn() && isClient()) || isManager()) {
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
                        echo "<p>".lang('Common.notFound.chat')."</p>";
                    }
                } else if (isContractor()) {
                    if (isset($clients) && is_array($clients) && count($clients) > 0){
                        echo '<div class="d-flex flex-row align-items-center justify-content-around" style="width: 60%;">';
                        echo '<section class="table-responsive" style="align-self: flex-start;">';
                        echo "<h2>" . $title . "<img alt='logo-lessons' class='ms-2 icons-medium' src=" . base_url("assets/images/svg/lessn-icon.svg") . " /></h2>";
                            echo '<table class="table">';

                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th scope="col">'.lang('Common.profile-picture').'</th>';
                                        echo '<th scope="col">'.lang('Common.name').'</th>';
                                    echo '</tr>';
                                echo '</thead>';

                                echo '<tbody class="table-group-divider">';
                                    foreach ($clients as $client){
                                        if ($client->iduser == getCurrentUserId()) {
                                            continue;
                                        }
                                        $redirection = base_url("/message/".$client->iduser);
                                        if (isLoggedIn() && isContractor()) {
                                            echo '<tr id="row-clickable-contractor" data-href='.$redirection.'>';
                                        } else {
                                            //for others
                                            echo "<tr data-href=".$redirection.">";
                                        }
                                        echo '<td><img src=' . base_url("assets/images/users/" . $client->profilepicture) . ' alt="profile_picture" class="icons-medium ms-3"/>';
                                        echo '<td>' . $client->firstname . ' ' . $client->lastname . '</td>';
                                        echo '</tr>';
                                    }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</section>";
                    } else {
                        if (isset($clients)) {
                            echo "<p>".lang('Common.notFound.chat')."</p>";
                        }
                    }
                    if (isset($managers) && is_array($managers) && count($managers) > 0){
                        echo '<section class="table-responsive">';
                        echo "<h2>" . lang('Common.title_message_manager') . "<img alt='logo-lessons' class='ms-2 icons-medium' src=" . base_url("assets/images/svg/lessn-icon.svg") . " /></h2>";
                            echo '<table class="table">';

                                echo '<thead>';
                                    echo '<tr>';
                                        echo '<th scope="col">'.lang('Common.profile-picture').'</th>';
                                        echo '<th scope="col">'.lang('Common.name').'</th>';
                                    echo '</tr>';
                                echo '</thead>';

                                echo '<tbody class="table-group-divider">';
                                    foreach ($managers as $manager){
                                        $redirection = base_url("/message/".$manager->idusers);
                                        if (isLoggedIn() && isContractor()) {
                                            echo '<tr id="row-clickable-contractor" data-href='.$redirection.'>';
                                        } else {
                                            //for others
                                            echo "<tr data-href=".$redirection.">";
                                        }
                                        echo '<td><img src=' . base_url("assets/images/users/" . $manager->profilepicture) . ' alt="profile_picture" class="icons-medium ms-3"/>';
                                        echo '<td>' . $manager->firstname . ' ' . $manager->lastname . '</td>';
                                        echo '</tr>';
                                    }
                        echo "</tbody>";
                        echo "</table>";
                        echo "</section>";
                    } else {
                        echo "<p>".lang('Common.notFound.chat')."</p>";
                    }
                    echo "</div>";
                }

    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>

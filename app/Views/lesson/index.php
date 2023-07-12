<?php
function displayDifficultyLevel( $difficulty )
{
    echo '<td>';
    for ($i = 0; $i<$difficulty;$i++) {
        echo '<img src=' . base_url("assets/images/svg/star-icon-red.svg") . ' alt="modify-icon" class="icons" />';
    }
    echo "</td>";

}

echo $this->include('layouts/head');
helper('form');

    echo '<body>';
    echo $this->include('layouts/header');

    echo "<h1>" . $title . "<img alt='logo-lessons' class='ms-2 icons-medium' src=" . base_url("assets/images/svg/lessn-icon.svg") . " /></h1>";

    echo "<nav class='navbar navbar-light'>";
    echo "<div class='container-fluid mb-4'>";
    $action = base_url('lessons');
    echo "<form class='d-flex' action=" . $action . " method='post'>";
    echo "<input class='form-control me-2 form-cookmaster' type='search' placeholder=" . lang('Common.search') . " aria-label='Search' name='search'>";
    echo form_submit('', lang('Common.search'), 'class="btn blue-btn form-control"');
    echo "</form>";
    echo "</div>";
    echo "</nav>";

        if (isContractor()){
            echo '<div>';
            echo '<a href="/lesson/create"><img src=' . base_url("assets/images/svg/lesson-add-icon.svg") . ' alt="plus-icon" class="icons ms-3 me-3" /></a>';
            echo '<a href="/lessonGroup/add"><img src=' . base_url("assets/images/svg/add-circle-icon.svg") . ' alt="plus-icon" class="icons ms-3 me-3" /></a>';
            echo '<a href="/lessonGroups"><img src=' . base_url("assets/images/svg/package-icon-blue.svg") . ' alt="plus-icon" class="icons ms-3 me-3" /></a>';
            echo '</div>';
        }
if (isset($lessons) && is_array($lessons) && count($lessons) > 0){
    echo '<section id="users-table" class="table-responsive">';
        echo '<table class="table">';

            echo '<thead>';
                echo '<tr>';
                    echo '<th scope="col">'.lang('Common.name').'</th>';
                    echo '<th scope="col">'.lang('Common.description').'</th>';
                    echo '<th scope="col">'.lang('Common.author').'</th>';
                    echo '<th scope="col">'.lang('Common.difficulty').'</th>';
                    echo '<th scope="col">'.lang('Common.actions').'</th>';
                echo '</tr>';
            echo '</thead>';

            echo '<tbody class="table-group-divider">';


                    foreach ($lessons as $lesson){
                        $redirection = base_url("/lesson/".$lesson->idlesson);
                        if (isLoggedIn() && isClient()) {
                            echo '<tr id="row-clickable-client" data-href='.$redirection.'>';
                        } else {
                            //for others
                            echo "<tr data-href=".$redirection.">";
                        }
                        echo "<td>$lesson->name</td>";
                        echo "<td>$lesson->description</td>";
                        echo "<td>$lesson->firstname $lesson->lastname</td>";
                        displayDifficultyLevel($lesson->difficulty);

                        $currentId = getCurrentUserId();
                        if ($currentId == $lesson->iduser || isManager()){
                            echo "<td>";
                                echo '<a href="/lesson/delete/' . $lesson->idlesson . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                                echo '<a href="/lesson/edit/' . $lesson->idlesson . '"><img src=' . base_url("assets/images/svg/edit-icon.svg") . ' alt="modify-icon" class="icons ms-3" /></a>';
                             echo "</td>";
                        }
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

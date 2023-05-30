<?php
function displayDifficultyLevel( $difficulty )
{
    echo '<td>';
    for ($i = 0; $i<$difficulty;$i++) {
        echo '<img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" />';
    }
    echo "</td>";

}

echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "<img alt='logo' class='' src=" . base_url("assets/images/svg/moon-icon.svg") . " /></h2>";

    if (isset($message)) {
            try {
                echo $message ;
            } catch (\Exception $e) {
                echo "Something went wrong. Please try again later.";
            }
        }
        if (isContractor()){
            echo '<div>';
            echo '<a href="/lesson/create"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="plus-icon" class="icons" /></a>';
            echo '<a href="/lessonGroup/add"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="plus-icon" class="icons" /></a>';
            echo '</div>';
        }

    echo '<section class="table-responsive">';
        echo '<table class="table">';

            echo '<thead>';
                echo '<tr>';
                    echo '<th scope="col">Name</th>';
                    echo '<th scope="col">Description</th>';
                    echo '<th scope="col">Author</th>';
                    echo '<th scope="col">Difficulty</th>';
                    echo '<th scope="col">Actions</th>';
                echo '</tr>';
            echo '</thead>';

            echo '<tbody class="table-group-divider">';

            if (isset($lessons) && is_array($lessons) && count($lessons) > 0){
                    foreach ($lessons as $lesson){
                        echo "<tr>";
                        echo "<td>$lesson->name</td>";
                        echo "<td>$lesson->description</td>";
                        echo "<td>Author</td>";
                        displayDifficultyLevel($lesson->difficulty);

                        if (isContractor() || isManager()){
                            echo "<td>";
                                echo '<a href="/lesson/delete/' . $lesson->idlesson . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                                echo '<a href="/lesson/edit/' . $lesson->idlesson . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                             echo "</td>";
                        }
                    }
                } else {
                    echo "<p>There are no lessons yet.</p>";
                }
                echo "</tbody>";
                echo "</table>";
        echo "</section>";
    echo '</main>';

    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

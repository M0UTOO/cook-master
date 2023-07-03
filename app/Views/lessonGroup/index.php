<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h2>" . $title . "<img alt='logo' class='ms-3' src=" . base_url("assets/images/svg/package-icon-blue.svg") . " /></h2>";

    if (isset($message)) {
            try {
                echo $message ;
            } catch (\Exception $e) {
                echo "Something went wrong. Please try again later.";
            }
        }
        if (isContractor()){
            echo '<a href="/lessonGroup/add/group"><img src=' . base_url("assets/images/svg/package-icon-blue.svg") . ' alt="plus-icon" class="icons" /></a>';
        }

    if (isset($lessonGroups) && is_array($lessonGroups) && count($lessonGroups) > 0){
        echo '<section class="table-responsive" id="all-lessonGroups">';
            echo '<table class="table">';
                echo '<thead>';
                    echo '<tr>';
                        echo '<th scope="col">#</th>';
                        echo '<th scope="col">Name</th>';
                        echo '<th scope="col">Actions</th>';
                    echo '</tr>';
                echo '</thead>';

                echo '<tbody class="table-group-divider">';

                $count = 0;

                foreach ($lessonGroups as $lessonGroup){
                    if ($lessonGroup->idlessongroup != 1) {
                        $count++;
                        echo "<tr>";
                        echo "<td>$count</td>";
                        echo "<td>$lessonGroup->name</td>";
                        if (isContractor()) {
                            echo '<td>';
                                echo '<a href="/lessonGroup/delete/' . $lessonGroup->idlessongroup . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                            echo '</td>';
                        }
                        echo "</tr>";
                    }
                }
            } else {
                echo "<p>There are no lessonGroups yet.</p>";
            }
            echo '</tbody>';
        echo '</table>';
    echo "</section>";
    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>
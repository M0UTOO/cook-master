<?php
echo $this->include('layouts/head') ;

echo '<body>';
    echo $this->include('layouts/header') ;

    function displayDifficultyLevel( $difficulty )
    {
        echo '<div id="difficulty-stars">';
        for ($i = 0; $i<$difficulty;$i++) {
            echo '<img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" />';
        }
        echo "</div>";

    }
    echo '<div class="ad-spot" style="min-height: 5rem; min-width: 50vw;background-color: var(--placeholder-color);">ADD SPOT</div>';

    echo "<section id='lesson-info d-flex' style='min-width: 100%'>";
        if (isset($lesson)){

            echo "<div class='lesson-card d-flex flex-column'>";
            $currentId = getCurrentUserId();
            if (isManager() || $currentId == $lesson['iduser']){
                echo '<div class="">';
                echo '<a class="me-3" href="/lesson/delete/' . $lesson["idlesson"] . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '<a href="/lesson/edit/' . $lesson["idlesson"] . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '</div>';
            }

            echo '<div>';
                echo "<h1>";
                    echo $lesson['name'] ;
                echo "</h1>";
                echo "<div class='d-flex'>";
                        echo '<h3>Difficulté:</h3>';
                        displayDifficultyLevel($lesson['difficulty']);
                echo '</div>';
            echo '</div>';

            echo '<div>';
            echo "<p>By:" . $lesson['firstname'] . " " . $lesson['lastname'] . "</p>";
            echo "<p>". $lesson['content']."</p>";
            echo '</div>';
            echo "</div>";
        }

    echo "</section>";

        echo "<section id='other-lessons'>";
        //TODO: DISPLAY SMALL CARDS OF THE NEXT LESSON OF THE GROUP OR RANDOM OTHER LESSON.
        //echo $this->include("suggested_lessons");
        echo "</section>";

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

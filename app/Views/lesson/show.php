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

            echo "<div class='lesson-info d-flex flex-rows'>";
            echo "<div class='lesson-card d-flex flex-column info-1'>";
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
                        echo '<h3>Difficulty:</h3>';
                        displayDifficultyLevel($lesson['difficulty']);
                echo '</div>';
            echo '</div>';

            echo '<div>';
            echo "<p>By:" . $lesson['firstname'] . " " . $lesson['lastname'] . "</p>";
            echo "<p>". $lesson['content']."</p>";
            echo '</div>';
            echo "</div>";
            echo '<img src=' . base_url("assets/images/lessons/") . $lesson['picture'] . ' alt="lesson-picture" class="lesson-image info-2"/>';
            echo "</div>";
        }

    echo "</section>";

        echo "<section id='other-lessons'>";
            if (isset($lessonGroup)){
                if ($others == true){
                    echo "<h2 class='title-suggestion'>Other lessons from this group :</h2>";
                } else {
                    echo "<h2 class='title-suggestion'>Other random lessons  :</h2>";
                }
            echo "<div class='lesson-suggestion flex-rows'>";
                foreach ($lessonGroup as $suggestedLesson){
                    $redirection = base_url("/lesson/".$suggestedLesson->idlesson);
                    echo "<div class='lesson-suggest flex-column'>";
                    echo "<a href=".$redirection." class='card-suggestion'>";
                    echo "<h5>";
                    echo $suggestedLesson->name ;
                    echo "</h5>";
                    echo "<div class='lesson-difficulty d-flex flex-rows'>";
                    echo '<h6>Difficulty:</h6>';
                    displayDifficultyLevel($suggestedLesson->difficulty);
                    echo '</div>';
                    echo '<img src=' . base_url("assets/images/lessons/") . $suggestedLesson->picture . ' alt="lesson-picture" class="lesson-image-suggestion"/>';
                    echo "</div>";
                    echo "</a>";
                }
            echo "</div>";
            }
        echo "</section>";

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

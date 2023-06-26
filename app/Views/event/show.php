<?php
echo $this->include('layouts/head') ;

echo '<body>';
    echo $this->include('layouts/header') ;

    if (isset($message)) {
        try {
            echo $message ;
        } catch (\Exception $e) {
            echo "Something went wrong. Please try again later.";
        }
    }
    echo '<div class="ad-spot" style="min-height: 5rem; min-width: 50vw;background-color: var(--placeholder-color);">ADD SPOT</div>';

    echo "<section id='lesson-info d-flex' style='min-width: 100%'>";
        if (isset($event)){

            echo "<div class='lesson-card d-flex flex-column'>";
            if (isManager() || isContractor()){
                echo '<div class="">';
                echo '<a class="me-3" href="/event/delete/' . $event["idevent"] . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                echo '<a href="/event/edit/' . $event["idevent"] . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                echo '</div>';
            }

            echo '<div class="d-flex flex-rows event-info mt-4">';
                echo '<div>';
                    echo '<div>';
                        echo "<h1>";
                            echo $event['name'] ;
                        echo "</h1>";
                    echo '</div>';

                    echo '<div class="mt-4">';
                        echo "<h2>";
                            echo $event['description'] ;
                        echo "</h2>";
                    echo '</div>';
                echo '</div>';

                echo '<div class="event-image">';
                    echo "<h3>";
                        echo "<img alt='event picture' class='' height='400em' width='400em' src=" . base_url("assets/images/events/" . $event['defaultpicture']) . " />";
                    echo "</h3>";
                echo '</div>';
            echo '</div>';

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

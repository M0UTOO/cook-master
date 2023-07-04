<?php
echo $this->include('layouts/head') ;

function displayDifficultyLevel( $difficulty )
{
    for ($i = 0; $i<$difficulty;$i++) {
        echo '<h3 class="me-2">⭐</h3>';
    }
}
$currentId = getCurrentUserId();

echo '<body>';

    echo $this->include('layouts/header') ;

    helper('form');

    echo "<h1 class='mb-3'>" . $title . "</h1>";

        echo "<div class='row grid-events' id='event-container'>"; //MAKE IT A GRID

        echo '<main class="container">';

        echo "<section class='account-cards' style='min-width: 100%;'>";

                foreach ($comments as $comment) {
                    $event = callAPI('/event/' . $comment->idevent, 'get');
                    echo '<h1 class="mb-3">Event : ' . $event['name'] . '</h1>';
                    echo '<div class="comment-container mb-4">';
                        echo '<div class="comment-header">';
                            echo '<div class="comment-user d-flex flex-row">';
                                echo '<div class="comment-user-image me-2">';
                                    echo "<img alt='user picture' class='' height='50em' width='50em' src=" . base_url("assets/images/users/" . $comment->picture) . " />";
                                echo '</div>';
                                echo '<div class="comment-user-name d-flex flex-row">';
                                    echo "<h3 class='me-2'>" . $comment->firstname . " " . $comment->lastname . " :</h3>";
                                    displayDifficultyLevel($comment->grade);
                                echo '</div>';
                                if ($comment->iduser == $currentId) {
                                    echo '<div class="d-flex flex-row">';
                                        echo '<a class="me-3" href="/comment/delete/' . $comment->idcomment . '/1"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                                        echo '<a href="/comment/edit/' . $comment->idcomment . '/1"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                                    echo '</div>';
                                }
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="comment-body">';
                            echo "<h3>" . $comment->content . "</h3>";
                        echo '</div>';
                        if ($comment->picture != "default.png") {
                            echo '<div class="comment-picture">';
                                echo "<img alt='' class='' height='400em' width='400em' src=" . base_url("assets/images/comments/" . $comment->picture) . " />";
                            echo '</div>';
                        }
                    echo '</div>';
                }

        echo "</div>";
        
        echo "</section>";

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

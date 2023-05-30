<?php
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
        if (isManager()){
            echo '<a href="/subscription/create"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="plus-icon" class="icons" /></a>';
        }

    echo "<section id='all-lessons'>";

            if (isset($lessons) && is_array($lessons) && count($lessons) > 0){
                //TODO: MAKE IT A TABLE !
                foreach ($lessons as $lesson){
                    echo "<div class='lesson-card'>";
                    echo "<h3>";
                    echo $lesson->name ;
                    if (isManager()){
                        echo '<a href="/lesson/delete/' . $lesson->idlesson . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                        echo '<a href="/lesson/edit/' . $lesson->idlesson . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                    }
                    echo "</h3>";
                    echo "<p>Welcome to Cookmaster, where we're passionate about making your culinary journey a deliciously unforgettable one".lesson->maxlessonaccess."</p>";
                    echo "<a href='#' class='btn'>Subscribe</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>There are no lessons yet.</p>";
            }

        echo "</section>";
    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

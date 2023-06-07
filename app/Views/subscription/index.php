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

    echo $this->include('subscription/subscriptions');

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>


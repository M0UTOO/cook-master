<?php
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    echo "<h1 class='h1-center'>" . $title . "</h1>";

        if (isManager()){
            echo '<a href="/subscription/create"><img src=' . base_url("assets/images/svg/add-circle-icon.svg") . ' alt="plus-icon" class="icons" /></a>';
        }

    echo $this->include('subscription/subscriptions');

    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>


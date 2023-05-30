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

echo "<section id='all-subscriptions'>";
    if (isset($subscription)){

        echo "<div class='subscription-card'>";
        echo "<h3>";
        echo $subscription['name'] ;
        if (isManager()){
            echo '<a href="/subscription/delete/' . $subscription["idsubscription"] . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
            echo '<a href="/subscription/edit/' . $subscription["idsubscription"] . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
        }
        echo "</h3>";
        echo "<p>Welcome to Cookmaster, where we're passionate about making your culinary journey a deliciously unforgettable one".$subscription['maxlessonaccess']."</p>";
        echo "<p id='subscription-price'>$".$subscription['price']."€/month</p>";
        echo "<a href='#' class='btn'>Subscribe</a>";
        echo "</div>";
    }

echo "</section>";
echo '</main>';
echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

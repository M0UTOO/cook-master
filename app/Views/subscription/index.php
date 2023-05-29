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

        if (session()->getFlashdata('message')){
            echo '<div class="alert alert-warning" role="alert">';
            echo session()->getFlashdata('message');
            echo '</div>';
        }
        if (isManager()){
            echo '<a href="/subscription/create"><img src=' . base_url("assets/images/svg/add-user-icon-blue.svg") . ' alt="plus-icon" class="icons" /></a>';
        }

    echo "<section id='all-subscriptions'>";

            if (isset($subscriptions) && is_array($subscriptions) && count($subscriptions) > 0){
                foreach ($subscriptions as $subscription){
                    echo "<div class='subscription-card'>";
                    echo "<h3>";
                    echo $subscription->name ;
                    if (isManager()){
                        echo '<a href="/subscription/delete/' . $subscription->idsubscription . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
                        echo '<a href="/subscription/edit/' . $subscription->idsubscription . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
                    }
                    echo "</h3>";
                    echo "<p>Welcome to Cookmaster, where we're passionate about making your culinary journey a deliciously unforgettable one".$subscription->maxlessonaccess."</p>";
                    echo "<p id='subscription-price'>$".$subscription->price."€/month</p>";
                    echo "<a href='#' class='btn'>Subscribe</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>There are no subscription plans yet.</p>";
            }

        echo "</section>";
    echo '</main>';
    echo $this->include('layouts/footer')
    ?>
    </body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>


<!--before-->
<!--echo "<a href='".base_url('subscription/'.$subscription->idsubscription)."' class='card'>";-->
<!--echo "<div class='card-header'>";-->
<!--    echo "Check this out !";-->
<!--    echo "</div>";-->
<!--echo "<div class='card-body'>";-->
<!--    echo "<h5 class='card-title'>".$subscription->name."</h5>";-->
<!--    echo "<p class='card-text'> Price : ". $subscription->price." €</p>";-->
<!--    echo "</div>";-->
<!--echo "</a>";-->
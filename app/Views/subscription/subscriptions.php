<?php
//SI LA PAGE C'EST SIGN_UP ALORS RENDRE CHAQUE DIV CLIQUABLE.
//il faut reussir a renvoyer l'info de la selection d'une subscription dans le form...
//MAYBE EN JS ?
echo "<section id='all-subscriptions'>";

if (isset($subscriptions) && is_array($subscriptions) && count($subscriptions) > 0){
    foreach ($subscriptions as $subscription){
        echo "<div onclick='selectSubscription($subscription->id,$subscription->name)' class='subscription-card' >";
        echo "<h3>";
        echo $subscription->name ;
        if (isManager()){
            echo '<a href="/subscription/delete/' . $subscription->idsubscription . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons" /></a>';
            echo '<a href="/subscription/edit/' . $subscription->idsubscription . '"><img src=' . base_url("assets/images/svg/moon-icon.svg") . ' alt="modify-icon" class="icons" /></a>';
        }
        echo "</h3>";
        echo "<p>Welcome to Cookmaster, where we're passionate about making your culinary journey a deliciously unforgettable one".$subscription->maxlessonaccess."</p>";
        echo "<p id='subscription-price'>".$subscription->price."€/month</p>";
        echo "<a href='#' class='btn'>Subscribe</a>";
        echo "</div>";
    }
} else {
    echo "<p>There are no subscription plans yet.</p>";
}

echo "</section>";

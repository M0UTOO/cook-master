<?php
//SI LA PAGE C'EST SIGN_UP ALORS RENDRE CHAQUE DIV CLIQUABLE.

echo "<section id='all-subscriptions'>";

if (isset($subscriptions) && is_array($subscriptions) && count($subscriptions) > 0){
    foreach ($subscriptions as $subscription){
        echo "<div onclick='' class='subscription-card' >";
        echo "<h3>";
        echo $subscription->name ;
        if (isManager()){
            echo '<a href="/subscription/delete/' . $subscription->idsubscription . '"><img src=' . base_url("assets/images/svg/trash-icon-red.svg") . ' alt="delete-icon" class="icons ms-2 me-2" /></a>';
            echo '<a href="/subscription/edit/' . $subscription->idsubscription . '"><img src=' . base_url("assets/images/svg/edit-icon.svg") . ' alt="modify-icon" class="icons ms-2 me-2" /></a>';
        }
        echo "</h3>";
        echo "<p>" . $subscription->description ."</p>";
        $spelling = ($subscription->maxlessonaccess > 1) ? " lessons" : " lesson";
        echo "<p>Access " . $subscription->maxlessonaccess. $spelling. " a day !</p>";
        echo "<p id='subscription-price'>".$subscription->price."€/month</p>";
        echo "<a href='".base_url('/checkout?subscription='.$subscription->idsubscription)."' class='btn'>Subscribe</a>";
        echo "</div>";
    }
} else {
    echo "<p>There are no subscription plans yet.</p>";
}

echo "</section>";

<?php

echo $this->include('layouts/head');

echo '<body>';
echo $this->include('layouts/header');

echo "<h2>" . $title . "</h2>";

//MIGHT BE COOL TO ACTUALLY DISPLAY ALL SUBSCRIPTION HERE IN A CAROUSEL
echo "<section id='focus-subscription'>";
if (isset($subscription)){
    echo "<div class='subscription-card'>";
    echo "<h3>";
    echo $subscription['name'] ;
    echo "</h3>";
    echo "<p>" . $subscription["description"] ."</p>";
    $spelling = ($subscription["maxlessonaccess"] > 1) ? " lessons" : " lesson";
    echo "<p>Access " . $subscription['maxlessonaccess'] .$spelling. " a day !</p>";
    echo "<p id='subscription-price'>".$subscription['price']."€/month</p>";
    echo "</div>";
}
echo "</section>";

echo $this->include('payment/checkout_form');
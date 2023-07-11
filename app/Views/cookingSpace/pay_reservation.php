<?php

echo $this->include('layouts/head');

echo '<body>';
echo $this->include('layouts/header');

echo "<h1>" . $title . "</h1>";

echo "<section id='focus-subscription'>";

if (isset($reservation)){
    echo "<div class='subscription-card'>";
        echo '<p>Your cooking space reservation will cost : '. $reservation . '€</p>';
        echo "<a class='btn blue-btn' href='/cookingSpace'>Back to cooking spaces</a>";
    echo "</div>";

}
echo "</section>";

echo $this->include('payment/checkout_form');
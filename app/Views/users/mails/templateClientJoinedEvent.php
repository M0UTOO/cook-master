<h1>Your new event</h1>

<p> Hello <?= $name ?></p>

<p>You have joined an event!</p>

<p>Thank you for registering for our cooking event. We are thrilled to have you join us. Here are the event details:</p>

<?php
if (isset($event)) {
    echo "<p>Event name: " . $event['name'] . "</p>";
    echo "<p>Event date: " . $event['starttime'] . "</p>";
    echo "<p><a href='" . base_url() . "/event/" . $event['idevent'] . "'>Check the event page here</a></p>";
}
?>

<p>
    Please arrive on time and bring your enthusiasm for a wonderful cooking experience. If you have any specific requirements or need further information, please let us know.
</p>
<p>We can't wait to cook and learn together!</p>

Best regards,

<h4>The Cookmaster Team</h4>
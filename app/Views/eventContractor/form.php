<?php

use App\Controllers\Event;
use App\Controllers\EventContractor;

helper('form');

echo $this->include('layouts/head') ;

    echo '<body>';
echo $this->include('layouts/header') ;

echo "<h2>" . $title . "</h2>";

    if (isset($message)) {
        try {
            echo $message ;
        } catch (\Exception $e) {
            echo "Something went wrong. Please try again later.";
        }
    }

    $hidden_input = [];
    $action = "eventContractor/add/";


    echo form_open($action, 'id="eventContractor-add-form" class=""', $hidden_input);

        echo '<div class="form-group">';
        echo form_label('Choose an event', "label-lessons");

        $events = new Event();
        $events = $events->getAllEvents();

        if (!empty($events)) {
            foreach ($events as $key) {
                $key = (array)$key;
                $tmp[$key['idevent']] = $key['name'];
            }
            echo form_dropdown('idevent', $tmp, '', 'class="form-control" required="required"');
        }
        else {
             echo '<p>No events found, please <a href="'.base_url('event/create').'">create</a>some first.</p>';
        }
        echo '</div>';

        echo '<div class="form-group">';
        echo form_label('Choose a contractor', "label-lessons");

        unset($tmp);
        unset($key);

        $contractors = new EventContractor();
        $contractors = $contractors->getAllContractors();

        if (isContractor()) {
            $tmp[$contractors['idcontractor']] = $contractors['email'];
            echo form_dropdown('idcontractor', $tmp, '', 'class="form-control" required="required"');
        } else {
            if (!empty($contractors)) {
                foreach ($contractors as $key) {
                    $key = (array)$key;
                    $tmp[$key['idcontractor']] = $key['email'];
                }
                echo form_dropdown('idcontractor', $tmp, '', 'class="form-control" required="required"');
            } else {
                echo '<p>No contractors found, please <a href="'.base_url('signIn').'">create</a>some first.</p>';
           }
           echo '</div>';
        }

        echo '<div class="form-group mb-3">';
        echo form_submit('', 'Save', 'class="btn blue-btn form-control mt-3"');
        echo '</div>';

    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

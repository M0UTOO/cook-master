<?php

use App\Controllers\LessonGroup;

    $hidden_input = ['user_id' => session()->get('id')];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    if ($url == "event/edit/") {
        $action = "event/edit/".$event['idevent'];
    } else {
        $action = "event/create";
    }
    echo form_open_multipart($action, 'id="event-create-form" class=""', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label('Event name' , "label-event-name");
                            $value = (isset($event) ? $event['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Name of event", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('Event type' , "label-event-type");
                $value = (isset($event) ? $event['type'] :'');
                echo form_input(['type'  => 'text', 'name'  => 'type', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Type of event (exemple: Demonstration,Conference,Degustation...)", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group">';
                echo form_label('Event start time' , "label-start-time");
                echo form_input(['type'  => 'datetime-local', 'name'  => 'starttime', 'class' => 'form-control', 'placeholder' => "Contract start date", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group">';
                echo form_label('Event end time' , "label-end-time");
                echo form_input(['type'  => 'datetime-local', 'name'  => 'endtime', 'class' => 'form-control', 'placeholder' => "Contract end date", 'required' => 'required']);
                echo '</div>';

                $booleans = [
                    'isprivate'  => 'Is a private event (customers house)',
                    'isinternal'    => 'Is an internal event (cooking space)',
                    'isclosed' => 'Is finished'
                ];
                $isChecked = true;


                echo "<div class='form-group'>";
                echo "<label>This event...?</label>";
                foreach ($booleans as $key => $value){
                    echo '<div class="form-check">';
                    echo '<input class="form-check-input" type="checkbox" id="check-'.$key.'" name='. $key .' value="'. $isChecked.'" >';
                    echo '<label class="form-check-label">'. $value .'</label>';
                    echo "</div>";
                }
                echo "</div>";


                echo '<div class="form-group mb-3">';
                    echo form_label('Event main picture' , "label-event-picture");
                    $value = (isset($event) ? $event['defaultpicture'] :'');
                    echo form_input(['type'  => 'file', 'name'  => 'defaultpicture','value' => $value, 'class' => 'form-control']);
                echo '</div>';

                //APPEAR BUT CAN'T BE MODIFIED BUT BY MANAGER.
                echo '<div class="form-group mb-3">'; //AUTHOR
                    echo form_label('Event creator' , "label-event-creator");
                    $value = (isset($author) ? $event['author'] :'');
                    echo form_input(['type'  => 'text', 'name'  => 'content','value' => $value, 'class' => 'form-control', 'disabled' =>'disabled'], );
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_submit('', 'Save', 'class="btn mt-3 blue-btn form-control"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

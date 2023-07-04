<?php

use App\Controllers\Comment;

    $hidden_input = ['user_id' => session()->get('id')];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    if ($url == "comment/edit//") {
        $action = "comment/edit/".$idcomment . "/" . $page . "";
    } else {
        $action = "comment/create/" . $idevent . "";
    }
    echo form_open_multipart($action, 'id="lesson-create-form" class=""', $hidden_input);

                echo form_hidden('idevent', $idevent);
                echo form_hidden('user_id', session()->get('id'));

                echo '<div class="form-group mb-3">';
                echo form_label('Comment text' , "label-lesson-description");
                  $value = (isset($comment) ? $comment['content'] :'');
                echo form_input(['type'  => 'textarea', 'name'  => 'content', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Content of comment", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label('Rate this event (1-5)' , "label-lesson-difficulty");
                    $value = (isset($comment) ? $comment['grade'] :'');
                    echo form_input(['type'  => 'range', 'min' => 1, 'max' => 5, 'step' => 1, 'name'  => 'grade', 'class' => 'form-control', 'value' => $value, 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label('Comment picture' , "label-lesson-picture");
                    echo form_input(['type'  => 'file', 'name'  => 'picture', 'class' => 'form-control']);
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

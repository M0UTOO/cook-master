<?php

use App\Controllers\LessonGroup;

    $hidden_input = ['user_id' => session()->get('id')];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    if ($url == "lesson/edit/") {
        $action = "lesson/edit/".$lesson['idlesson'];
    } else {
        $action = "lesson/create";
    }
    echo form_open_multipart($action, 'id="lesson-create-form" class=""', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label(lang('Common.lessonName') , "label-lesson-name");
                            $value = (isset($lesson) ? $lesson['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.lessonName'), 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label(lang('Common.lessonDescription') , "label-lesson-description");
                  $value = (isset($lesson) ? $lesson['description'] :'');
                echo form_input(['type'  => 'textarea', 'name'  => 'description', 'class' => 'form-control', 'value' => $value, 'placeholder' => lang('Common.lessonDescription'), 'required' => 'required']);
                echo '</div>';


                echo '<div class="form-group mb-3">'; //DIFFICULTY
                    echo form_label(lang('Common.lessonDifficulty') , "label-lesson-difficulty");
                    $value = (isset($lesson) ? $lesson['difficulty'] :'');
                    echo form_input(['type'  => 'range', 'min' => 1, 'max' => 5, 'step' => 1, 'name'  => 'difficulty', 'class' => 'form-control', 'value' => $value, 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">'; //CONTENT FILE OR LIN TO YTB VIDEO.
                    echo form_label(lang('Common.lessonContent')  , "label-lesson-content");
                    $value = (isset($lesson) ? $lesson['content'] :'');
                    echo form_input(['type'  => 'text', 'name'  => 'content','value' => $value, 'class' => 'form-control']);
                echo '</div>';

                //APPEAR BUT CAN'T BE MODIFIED BUT BY MANAGER.
                echo '<div class="form-group mb-3">'; //AUTHOR
                    echo form_label(lang('Common.lessonAuthor')  , "label-lesson-content");
                    $value = (isset($author) ? $lesson['author'] :'');
                    echo form_input(['type'  => 'text', 'name'  => 'author','value' => $value, 'class' => 'form-control', 'disabled' =>'disabled'], );
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_label(lang('Common.lessonPicture')  , "label-lesson-picture");
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

<?php

use App\Controllers\LessonGroup;

helper('form');
helper('url');
echo $this->include('layouts/head') ;

    echo '<body>';
    echo $this->include('layouts/header') ;

    if (isset($message)) {
        try {
            echo $message ;
        } catch (\Exception $e) {
            echo "Something went wrong. Please try again later.";
        }
    }

    $hidden_input = [];
    $url = uri_string();
    $url = preg_replace('/[0-9]+/', '', $url);
    if ($url == "lesson/edit/") {
        $action = "lesson/edit/".$lesson['idlesson'];
    } else {
        $action = "lesson/create";
    }

    echo form_open_multipart($action, 'id="lesson-create-form" class=""', $hidden_input);

                echo '<div class="form-group mb-3">';
                            echo form_label('Lesson name' , "label-lesson-name");
                            $value = (isset($lesson) ? $lesson['name'] :'');
                            echo form_input(['type'  => 'text', 'name'  => 'name', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Name of lesson", 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">';
                echo form_label('Lesson description' , "label-lesson-description");
                  $value = (isset($lesson) ? $lesson['description'] :'');
                echo form_input(['type'  => 'textarea', 'name'  => 'description', 'class' => 'form-control', 'value' => $value, 'placeholder' => "Description of lesson", 'required' => 'required']);
                echo '</div>';


                echo '<div class="form-group mb-3">'; //DIFFICULTY
                    echo form_label('Lesson difficulty (1-5)' , "label-lesson-difficulty");
                    $value = (isset($lesson) ? $lesson['difficulty'] :'');
                    echo form_input(['type'  => 'range', 'name'  => 'difficulty', 'class' => 'form-control', 'value' => $value, 'required' => 'required']);
                echo '</div>';

                echo '<div class="form-group mb-3">'; //CONTENT FILE OR LIN TO YTB VIDEO.
                    echo form_label('Lesson content' , "label-lesson-content");
                    echo form_input(['type'  => 'file', 'name'  => 'picture', 'class' => 'form-control']);
                echo '</div>';

                echo '<div class="form-group">';
                echo form_label('Lesson group', "label-lesson-group");

                $lessonGroups = new LessonGroup();
                $lessonGroups = $lessonGroups->getLessonGroups();

                //TODO: check what happens when empty array !
                if (!empty($lessonGroups)) {
                    foreach ($lessonGroups as $key) {
                        $key = (array)$key;
                        $tmp[$key['idlessongroup']] = $key['name'];
                    }
                    echo form_dropdown('idlessongroup', $tmp, '', 'class="form-control"');
                }
                else
                {
                    echo '<p>No lesson group found, please <a href="'.base_url('lessonGroup/create').'">create</a> one before creating a lesson.</p>';
                }
                echo '</div>';

                echo '<div class="form-group mb-3">';
                    echo form_submit('', 'Save', 'class="btn btn-primary mt-3"');
                echo '</div>';
    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
</html>

<?php

use App\Controllers\Lesson;
use App\Controllers\LessonGroup;

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
    $action = "lessonGroup/add/";


    echo form_open($action, 'id="lessonGroup-add-form" class=""', $hidden_input);

        echo '<div class="form-group">';
        echo form_label('Choose a lesson', "label-lessons");

        $lessons = new Lesson();
        $lessons = $lessons->getAllLessons();

        if (!empty($lessons)) {
            foreach ($lessons as $key) {
                $key = (array)$key;
                $tmp[$key['idlesson']] = $key['name'];
            }
            echo form_dropdown('idlesson', $tmp, '', 'class="form-control"');
        }
        else {
             echo '<p>No lessons found, please <a href="'.base_url('lesson/create').'">create</a>some first.</p>';
        }
        echo '</div>';

        echo '<div class="form-group">';
        echo form_label('Choose a lesson group', "label-lesson-group");

        $lessonGroups = new LessonGroup();
        $lessonGroups = $lessonGroups->getLessonGroups();

        //TODO: check what happens when empty array !


            echo '<input list="lesson-groups" id="lesson-group-choice" name="lesson-group-choice" class="form-control">';
            echo '<datalist id="lesson-groups">';
            if (!empty($lessonGroups)) {
                foreach ($lessonGroups as $key) {
                    $key = (array)$key;
                    echo '<option value="'.$key['idlessongroup'].'">'.$key['name'].'</option>';
                }
            }
            echo '</datalist>';
            //TODO: WHEN EXISTING GROUP CREATED : DISPLAY DIV WITH ALL LESSONS IN GROUP, BUTTON TO DELETE THE GROUP.
        echo '</div>';

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

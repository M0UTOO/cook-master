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
                    if ($key['idlessongroup'] != 1) {
                        echo '<option value="'.$key['idlessongroup'].'">'.$key['name'].'</option>';
                    }
                }
            }
            echo '</datalist>';

            echo form_label('Order in the group', "label-lesson-group");
            echo form_input('group_display_order', '', 'class="form-control"');

            //TODO: WHEN EXISTING GROUP CREATED : BUTTON TO DELETE THE GROUP.
        echo '</div>';

        echo '<div class="form-group mb-3">';
            echo form_submit('', 'Save', 'class="btn blue-btn form-control mt-3"');
        echo '</div>';

        echo '<div "w3-container" id="lesson-list"></div>';

    echo form_close();

    echo '</main>';
    echo $this->include('layouts/footer')
?>
</body>
<script src=<?= base_url('assets/js/create_users.js')?>></script>
<script>
    const token = '<?= env('API_TOKEN'); ?>'

    let input = document.getElementById('lesson-group-choice');

    input.addEventListener('input', function () {

        let selectedGroup = input.value;

        if (selectedGroup == 1) {
            let list = document.getElementById('lesson-list');
            list.innerHTML = '';
            let listlessontitle = document.createElement('h5');
            listlessontitle.innerHTML = "Cant add a lesson to the default group.";
            list.appendChild(listlessontitle);
        }

        if (selectedGroup.length > 0) {
            if (selectedGroup == 1) {
                return;
            }
            let url = 'http://localhost:9000/lesson/group/' + selectedGroup;

            const headers = new Headers();
            headers.append('Content-Type', 'application/json');
            headers.append('Token', token);

            fetch(url, {
               method: 'GET',
               headers: headers
            })
                .then(response => response.json())
                .then(data => {

                    let list = document.getElementById('lesson-list');
                    list.innerHTML = '';

                    if (data === null) {
                        let listlesson = document.createElement('li');
                        listlesson.innerHTML = "No lessons in this group yet.";
                        list.appendChild(listlesson);
                    } else {

                        let listlessontitle = document.createElement('h5');
                        listlessontitle.innerHTML = "Lessons in this group : ";
                        list.appendChild(listlessontitle);
                        data.forEach(function (lesson) {
                            let listlesson = document.createElement('li');
                            listlesson.innerHTML = "Name : " + lesson.name + " / Order : " + lesson.group_display_order;
                            list.appendChild(listlesson);
                        });
                    }
                });
        }
    });
</script>
</html>

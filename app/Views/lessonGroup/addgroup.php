<?php

use App\Controllers\Lesson;
use App\Controllers\LessonGroup;

helper('form');

echo $this->include('layouts/head') ;

    echo '<body>';
echo $this->include('layouts/header') ;

echo "<h2>" . $title . "</h2>";

    $hidden_input = [];
    $action = "lessonGroup/add/group/";


    echo form_open($action, 'id="lessonGroup-add-form" class=""', $hidden_input);

        echo form_label('Name of the group', "label-lesson-group");
        echo form_input('name', '', 'class="form-control"');

        echo '<div class="form-group mb-3">';
            echo form_submit('', 'Save', 'class="btn blue-btn form-control mt-3"');
        echo '</div>';

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
            let url = API_URL + selectedGroup;

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

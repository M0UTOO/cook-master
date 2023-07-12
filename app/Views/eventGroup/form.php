<?php

use App\Controllers\Event;
use App\Controllers\EventGroup;

helper('form');

echo $this->include('layouts/head') ;

    echo '<body>';
echo $this->include('layouts/header') ;

echo "<h1>" . $title . "</h1>";

    $hidden_input = [];
    $action = "eventGroup/add";


    echo form_open($action, 'id="eventGroup-add-form" class=""', $hidden_input);

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
        echo form_label('Choose a event formation or type the name of your new one', "label-lesson-group");

        $eventGroups = new EventGroup();
        $eventGroups = $eventGroups->getEventGroups();

        echo '<input list="lesson-groups" id="lesson-group-choice" name="lesson-group-choice" class="form-control" required="required">';
        echo '<datalist id="lesson-groups">';
        if (!empty($eventGroups)) {
            foreach ($eventGroups as $key) {
                $key = (array)$key;
                if ($key['idevent'] != 1) {
                    echo '<option value="'.$key['name'].'">'.$key['name'].'</option>';
                }
            }
        }
        echo '</datalist>';
        

            echo form_label('Order in the group', "label-lesson-group");
            echo form_input('group_display_order', '', 'class="form-control" required="required"');

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
        let idevent = 0;

        let url = '<?= env('API_URL'); ?>' + '/event/group/search/' + selectedGroup;
        const headers = new Headers();
            headers.append('Content-Type', 'application/json');
            headers.append('Token', token);

            fetch(url, {
               method: 'GET',
               headers: headers
            })
                .then(response => response.json())
                .then(data => {
                    idevent = data.idevent;
                });

        setTimeout(() => {eventsInGroup(idevent)}, 100);

        function eventsInGroup(idevent) {
            if (idevent == 1) {
                let list = document.getElementById('lesson-list');
                list.innerHTML = '';
                let listlessontitle = document.createElement('h5');
                listlessontitle.innerHTML = "Cant add a event to the default group.";
                list.appendChild(listlessontitle);
            }

            if (idevent == 1) {
                return;
            }
            let url = '<?= env('API_URL'); ?>' + '/event/group/' + idevent;

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
                        listlesson.innerHTML = "No events in this group yet.";
                        list.appendChild(listlesson);
                    } else {

                        let listlessontitle = document.createElement('h5');
                        listlessontitle.innerHTML = "Event in this group : ";
                        list.appendChild(listlessontitle);
                        data.forEach(function (lesson) {
                            let listlesson = document.createElement('li');
                            listlesson.innerHTML = "Name : " + lesson.name + " / Order : " + lesson.groupdisplayorder;
                            list.appendChild(listlesson);
                        });
                    }
                });
        }
    });
</script>
</html>

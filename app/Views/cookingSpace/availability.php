<?php

echo "<h2 class='align-self-start mt-4'>Availabilty</h2>";

echo "<div id='calendar' class='mt-4 mb-4 room-calendar'></div>";

?>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>

    let reservations = [];
    //foreach reservations fill the array with the reservations
    <?php
        //in 2023-05-31 22:27:34 take the space and replace it by a T with another function in php


    foreach ($reservations as $reservation){
        //CHANGE DATE FORMAT BECAUSE OF THE LIBRARY : ISO 8601
        $startTime= (new DateTime($reservation['starttime']))->format('Y-m-d\TH:i:s');
        $endTime= (new DateTime($reservation['endtime']))->format('Y-m-d\TH:i:s');
        echo "reservations.push({title: 'Client reservation',color: '#4D47A7','allDay': false, start: '".$startTime."', end: '".$endTime."'});";
    }
    ?>
    reservations.push({title: 'Client reservation', start: '2023-07-08T12:00:00', end: '2023-07-08T16:00:00', color: '#4D47A7'});
    console.log(reservations);

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            allDaySlot: false,
            slotMinTime: "07:00:00",
            slotMaxTime: "21:00:00",
            themeSystem: 'bootstrap5',
            expandRows: true,
            businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                daysOfWeek: [ 0, 1, 2, 3, 4, 5, 6 ],
                startTime: '8:00',
                endTime: '20:00',
            },
            selectable: true,
            selectMirror: true,
            selectOverlap: false,
            selectConstraint: 'businessHours',
            events: reservations,
            headerToolbar: {
                left: 'title',
            },
            eventClick: function(info) {
                alert('Event: ' + info.event.title);
                //info.el.style.borderColor = 'green';
            },
            select: function(info) {
                //redirect to controller to allow user to make a reservation
                alert('selected ' + info.startStr + ' to ' + info.endStr);
            }
        });
        calendar.render();
    });

</script>
<script src=<?= base_url('assets/js/tables.js')?>></script>



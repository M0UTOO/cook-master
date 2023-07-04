<?php

echo "<h2 class='mt-4'>Availabilty</h2>";

echo "<div id='calendar' class='mt-4 room-calendar'></div>";

?>
</body>

<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>

    let reservations = [];
    //foreach reservations fill the array with the reservations
    <?php
    foreach ($reservations as $reservation){
        echo "reservations.push({title: 'ReservationX','allDay': false, start: '".$reservation['starttime']."', end: '".$reservation['endtime']."'});";
    }
    ?>
    reservations.push({title: 'ReservationX', start: '2023-07-08', end: '2023-07-09'});
    console.log(reservations);

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridWeek',
            allDaySlot: false,
            slotMinTime: "07:00:00",
            slotMaxTime: "19:00:00",
            themeSystem: 'bootstrap5',
            timeZone: 'UTC',
            businessHours: {
                // days of week. an array of zero-based day of week integers (0=Sunday)
                daysOfWeek: [ 0, 1, 2, 3, 4, 5, 6 ],

                startTime: '9:00',
                endTime: '18:00',
            },
            events: reservations,
            // headerToolbar: {
            //     left: 'prev,next',
            //     center: 'title',
            // }
        });
        calendar.render();
    });

</script>
<script src=<?= base_url('assets/js/tables.js')?>></script>
</html>


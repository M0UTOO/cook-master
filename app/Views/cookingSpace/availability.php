<?php

echo $this->include('cookingSpace/confirmEventsModal') ;
echo "<h2 class='align-self-start mt-4'>Availabilty</h2>";

echo "<div id='calendar' class='mt-4 mb-4 room-calendar'></div>";

?>

</main>
<?php echo $this->include('layouts/footer') ; ?>
</html>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js'></script>
<script>

    let reservations = [];
    //foreach reservations fill the array with the reservations
    <?php
    foreach ($reservations as $reservation){
        //CHANGE DATE FORMAT BECAUSE OF THE LIBRARY : ISO 8601
        $startTime= (new DateTime($reservation['starttime']))->format('Y-m-d\TH:i:s');
        $endTime= (new DateTime($reservation['endtime']))->format('Y-m-d\TH:i:s');
        echo "reservations.push({title: 'Client reservation',color: '#4D47A7','allDay': false, start: '".$startTime."', end: '".$endTime."'});";
    }
    ?>
    //TESTING
    reservations.push({title: 'Client reservation', start: '2023-07-08T12:00:00', end: '2023-07-08T16:00:00', color: '#4D47A7'});
    console.log(reservations);

    document.addEventListener('DOMContentLoaded', function() {
        var htmlmodal = document.getElementById("confirmEventModal");
        var modal = new bootstrap.Modal(htmlmodal);
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
                //set info of the modale with info then show it

                let startTime = moment(info.start).format('HH:mm:ss');
                let selectElement = document.getElementById("book-start-time");
                let options = selectElement.options;
                for (let i = 0; i < options.length; i++) {
                    if (options[i].value == startTime) {
                        options[i].selected = true;
                        break;
                    }
                }
                let endTime = moment(info.end).format('HH:mm:ss');
                let selectElementEnd = document.getElementById("book-end-time");
                let optionsEnd = selectElementEnd.options;
                for (let i = 0; i < optionsEnd.length; i++) {
                    if (optionsEnd[i].value == endTime) {
                        optionsEnd[i].selected = true;
                        break;
                    }
                }

                let dateInput = document.getElementById("book-date");
                let date = info.start.toISOString().split('T')[0];
                dateInput.value = date;
                modal.show();
            }
        });
        calendar.render();
    });

</script>


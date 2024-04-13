<?php
session_start(); // Put this at the top of each PHP file

// Store data in session variables after submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['selectedServiceId'] = $_POST['selectedServiceId'];
    $_SESSION['selectedBarberId'] = $_POST['selectedBarberId'];
    
    if (empty($_SESSION['selectedServiceId']) || empty($_SESSION['selectedBarberId'])) {
        // Redirect back to the form with an error message
        header("Location: app.php?error=Please select both a service and a barber");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css" />
    <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"crossorigin="anonymous">          
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="manifest" href="site.webmanifest"> 
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="manifest" href="site.webmanifest">
    <link rel="shortcut icon" type="image/x-icon" href="../assets/img/favicon.ico">

    <!-- CSS here -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="../assets/css/slicknav.css">
    <link rel="stylesheet" href="../assets/css/flaticon.css">
    <link rel="stylesheet" href="../assets/css/gijgo.css">
    <link rel="stylesheet" href="../assets/css/animate.min.css">
    <link rel="stylesheet" href="../assets/css/animated-headline.css">
    <link rel="stylesheet" href="../assets/css/magnific-popup.css">
    <link rel="stylesheet" href="../assets/css/fontawesome-all.min.css">
    <link rel="stylesheet" href="../assets/css/themify-icons.css">
    <link rel="stylesheet" href="../assets/css/slick.css">
    <link rel="stylesheet" href="../assets/css/nice-select.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="style1.css">
    
</head>
<body>
<div id="messageArea" style="display: none; color: green; position: absolute; top: 20px; left: 50%; transform: translateX(-50%); background: #f0f0f0; padding: 10px; border-radius: 5px; border: 1px solid green;">nothing</div>

<div class="all" style="border:solid black;width:30%;border-radius: 35px;padding-bottom:20px; height: 50%;padding:10px;">
    <div class="calendar-controls">
        <button onclick="navigateMonth(-1)">&lt; Prev</button>
            <span class="month-year" id="monthYearLabel"></span>
            <button onclick="navigateMonth(1)">Next &gt;</button>
        </div> 
        
        <div class="calendar-grid" id="appointmentDateInput">
  <!-- Calendar days will be generated by JavaScript -->
    </div>
</div>
    <!-- <input type="date" id="appointmentDateInput"> Added an ID to the input -->
</div>
<div id="modal">
    <div id="modalContent">
        <span class="close">&times;</span>
        <div id="slotsContainer"></div>
        <button id="submitTimeSlot" class="submit-btn" style="display:none;">Submit</button>
    </div>
</div>
<script>
const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
const dayNames = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];
let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();
let selDate = '';


function generateCalendar(month, year) {
  const firstDay = new Date(year, month, 1).getDay();
  const daysInMonth = new Date(year, month + 1, 0).getDate();
  const calendarGrid = document.getElementById('appointmentDateInput');
  const monthYearLabel = document.getElementById('monthYearLabel');
  monthYearLabel.textContent = `${monthNames[month]} ${year}`;
  
  

  // Clear previous calendar
  calendarGrid.innerHTML = dayNames.map(day => `<div class="calendar-day-name">${day}</div>`).join('');

  // Fill initial empty slots
  for (let i = 0; i < firstDay; i++) {
    calendarGrid.innerHTML += '<div class="calendar-day empty"></div>';
  }

  // Fill actual days
  for (let day = 1; day <= daysInMonth; day++) {
    calendarGrid.innerHTML += `<div class="calendar-day" data-date="${year}-${month+1}-${day}">${day}</div>`;
  } 
  document.querySelectorAll('.calendar-day').forEach(day => {
        day.addEventListener('click', function() {
            const selectedDate = this.getAttribute('data-date');            
            fetchSlots(selectedDate);
            showModal();
            
        });
    });
  
}

let navigateCount = 0; // Initialize counter for forward navigation steps

function navigateMonth(step) {
    if (step > 0 && navigateCount >= 3) { // Prevent going forward more than 3 months
        alert("You can only navigate up to 3 months ahead.");
        return; // Stop the function from running further
    }
    
    // Update month and year based on navigation step
    currentMonth += step;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
        navigateCount = Math.max(navigateCount - 1, 0); // Decrease count if moving backwards
    } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
        if (step > 0) navigateCount++; // Only increase count if moving forwards
    }
    
    generateCalendar(currentMonth, currentYear);
}

document.addEventListener('DOMContentLoaded', () => {
    generateCalendar(currentMonth, currentYear);
});



// _____________________________________



document.getElementById('appointmentDateInput').addEventListener('change', function() {
    const selectedDate = this.value;
    alert(document.getElementById('appointmentDateInput').value);
    fetchSlots(selectedDate);
    showModal();
});

function fetchSlots(date) {
    fetch(`fetch_slots.php?date=${date}`)
        .then(response => response.json())
        .then(slots => {
            displaySlots(slots, date);
        })
        .catch(error => {
            console.error('Error fetching time slots:', error);
        });
}

function displaySlots(slots, date) {
    const container = document.getElementById('slotsContainer');
    container.innerHTML = ''; // Clear previous slots
    const dayOfWeek = new Date(date).getDay(); // Get the day of the week from the date, where 1 is Monday
    slots.forEach(slot => {
        // Check if it's Monday and the slot time is 8:00
        if ((dayOfWeek === 1 && (slot.id == 23 || slot.id == 20)) || (dayOfWeek === 2 && (slot.id == 23 || slot.id == 20)) || (dayOfWeek === 3 && (slot.id == 23 || slot.id == 20))
        || (dayOfWeek === 5 && (slot.id == 23 || slot.id == 20))){//epilego ti tha kano display 
            // Log to console or perform other actions - slot not displayed
            
        } else {
          
            const div = document.createElement('div');
            div.className = 'time-slot' + (slot.status === 'booked' ? ' booked' : '');
            div.textContent = `${slot.start_time} - ${slot.status}`;
            if (slot.status === 'available') {
                div.onclick = function() {
                    selectSlot(this, slot.id, date);
                };
            }
            container.appendChild(div);
        }
    });
}

let selectedSlotId = null;
function selectSlot(element, slotId,date) {
    selDate = date;
    if (element.classList.contains('selected')) {
        element.classList.remove('selected');
        document.getElementById('submitTimeSlot').style.display = 'none';
        selectedSlotId = null;
    } else {
        document.querySelectorAll('.time-slot').forEach(el => el.classList.remove('selected'));
        element.classList.add('selected');
        selectedSlotId = slotId;
        document.getElementById('submitTimeSlot').style.display = 'block';
    }
}

let selectedDate;  // Define this at the top of your script to keep track of the selected date

document.querySelectorAll('.calendar-day').forEach(day => {
    day.addEventListener('click', function() {
        document.querySelectorAll('.calendar-day.selected').forEach(d => d.classList.remove('selected'));
        this.classList.add('selected'); // Highlight the selected day
        selectedDate = this.getAttribute('data-date');  // Store the date from the clicked day
        selectedSlotId = this.dataset.slotId;  // Assuming you have slot IDs assigned to days
        document.getElementById('submitTimeSlot').style.display = 'block';  // Show the submit button
    });
});

document.getElementById('submitTimeSlot').onclick = function() {
    if (selectedSlotId && selDate) {  // Ensure a date is selected
        bookSlot(selectedSlotId, selDate);  // Use the stored date
    } else {
        alert('No date selected!');  // Alert if no date is selected
    }
};

function bookSlot(slotId, date) {
    const data = new URLSearchParams({
        time_slot_id: slotId,
        date: date,
        
        client_name: 'Example Client'
    });

    fetch('book_appointment.php', {
        method: 'POST',
        body: data,
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        }
    })
    .then(response => response.json()) // This happens when he is pressing the button to submit
    .then(result => {
        const messageArea = document.getElementById('messageArea');
        // Show the message area
        hideModal(); // Close the modal after booking
        window.location.href = 'app.php?message=' + encodeURIComponent(result.message);// Redirect to app.php with a success parameter
        fetchSlots(date); // Refresh the slots to reflect the booked status
        displayMessage(result.message);
        // Change to redirect to app.php after 3 seconds, passing a query parameter if needed
        setTimeout(() => {
             
        }, 3000); 
    })
    .catch(error => {
        console.error('Error booking the slot:', error);
        displayMessage('Error booking the slot.'); // Display error message
    });
}
function hideModal() {
    document.getElementById('modal').style.display = 'none';
}

function showModal() {
    document.getElementById('modal').style.display = 'block';
}

document.getElementsByClassName('close')[0].onclick = function() {
    document.getElementById('modal').style.display = 'none';
    window.location.reload();
}

window.onclick = function(event) {
    if (event.target == document.getElementById('modal')) {
        document.getElementById('modal').style.display = 'none';
        window.location.reload();
    }
}

function displayMessage(message) {
    const messageArea = document.getElementById('messageArea');
    messageArea.textContent = message;
    messageArea.style.display = 'block';
    setTimeout(() => {
        messageArea.style.display = 'none';
    }, 3000); // Message will disappear after 3000 ms (3 seconds)
}

document.addEventListener('DOMContentLoaded', () => {
    generateCalendar(currentMonth, currentYear);
});
function generateCalendar(month, year) {
    const today = new Date();
    today.setHours(0, 0, 0, 0);  // Normalize today to start of day for fair comparison
    const firstDay = new Date(year, month, 1).getDay();
    const daysInMonth = new Date(year, month + 1, 0).getDate();
    const calendarGrid = document.getElementById('appointmentDateInput');
    const monthYearLabel = document.getElementById('monthYearLabel');
    monthYearLabel.textContent = `${monthNames[month]} ${year}`;

    calendarGrid.innerHTML = dayNames.map(day => `<div class="calendar-day-name">${day}</div>`).join('');

    for (let i = 0; i < firstDay; i++) {
        calendarGrid.innerHTML += '<div class="calendar-day empty"></div>';
    }

    for (let day = 1; day <= daysInMonth; day++) {
        const date = new Date(year, month, day);
        let className = 'calendar-day';
        let dayOfWeek = date.getDay();
        let dateTomorrow = new Date(year, month, day-1) ;
        let latestDayBook = new Date(year, month);
        if (dateTomorrow <= today || dayOfWeek === 0 || dayOfWeek === 4 ) { // Block past days, Sundays and Thursdays and previows days. you can only book appointment one day in advance
            className += ' unavailable';
        } else {
            className += ' available';
        }
        calendarGrid.innerHTML += `<div class="${className}" data-date="${year}-${month+1}-${day}">${day}</div>`;
    }

    document.querySelectorAll('.calendar-day.available').forEach(day => {
        day.addEventListener('click', function() {
            document.querySelectorAll('.calendar-day').forEach(d => d.classList.remove('selected'));
            this.classList.add('selected'); // Highlight the selected day
            const selectedDate = this.getAttribute('data-date');
            fetchSlots(selectedDate);
            showModal();
        });
    });
}


</script>
    
<script src="../assets/js/vendor/modernizr-3.5.0.min.js"></script>
    <!-- Jquery, Popper, Bootstrap -->
    <script src="../assets/js/vendor/jquery-1.12.4.min.js"></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- Jquery Mobile Menu -->
    <script src="../assets/js/jquery.slicknav.min.js"></script>

    <!-- Jquery Slick , Owl-Carousel Plugins -->
    <script src="../assets/js/owl.carousel.min.js"></script>
    <script src="../assets/js/slick.min.js"></script>
    <!-- One Page, Animated-HeadLin -->
    <script src="../assets/js/wow.min.js"></script>
    <script src="../assets/js/animated.headline.js"></script>
    <script src="../assets/js/jquery.magnific-popup.js"></script>

    <!-- Date Picker -->
    <script src="../assets/js/gijgo.min.js"></script>
    <!-- Nice-select, sticky -->
    <script src="../assets/js/jquery.nice-select.min.js"></script>
    <script src="../assets/js/jquery.sticky.js"></script>

    <!-- counter , waypoint,Hover Direction -->
    <script src="../assets/js/jquery.counterup.min.js"></script>
    <script src="../assets/js/waypoints.min.js"></script>
    <script src="../assets/js/jquery.countdown.min.js"></script>
    <script src="../assets/js/hover-direction-snake.min.js"></script>

    <!-- contact js -->
    <script src="../assets/js/contact.js"></script>
    <script src="../assets/js/jquery.form.js"></script>
    <script src="../assets/js/jquery.validate.min.js"></script>
    <script src="../assets/js/mail-script.js"></script>
    <script src="../assets/js/jquery.ajaxchimp.min.js"></script>

    <!-- Jquery Plugins, main Jquery -->
    <script src="../assets/js/plugins.js"></script>
    <script src="../assets/js/main.js"></script>

</body>
</html>
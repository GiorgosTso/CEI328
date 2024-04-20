<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Appointment</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div id="messageArea" style ="display: none; color: green; position: relative;">The appointment added successfully</div>
<h2>Book an Appointment</h2>
<label for="appointmentDateInput">Select Date:</label>
<div id="appointmentDate">
    <input type="date" id="appointmentDateInput"> <!-- Added an ID to the input -->
</div>
<div id="modal">
    <div id="modalContent">
        <span class="close">&times;</span>
        <div id="slotsContainer"></div>
        <button id="submitTimeSlot" class="submit-btn" style="display:none;">Submit</button>
    </div>
</div>

<script>
document.getElementById('appointmentDateInput').addEventListener('change', function() {
    const selectedDate = this.value;
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
    container.innerHTML = '';  // Clear previous slots
    slots.forEach(slot => {
        const div = document.createElement('div');
        div.className = 'time-slot' + (slot.status === 'booked' ? ' booked' : '');
        div.textContent = `${slot.start_time} - ${slot.status}`;
        if (slot.status === 'available') {
            div.onclick = function() {
                selectSlot(this, slot.id);
            };
        }
        container.appendChild(div);
    });
}

let selectedSlotId = null;
function selectSlot(element, slotId) {
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

document.getElementById('submitTimeSlot').onclick = function() {
    if (selectedSlotId) {
        bookSlot(selectedSlotId, document.getElementById('appointmentDateInput').value);
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
    .then(response => response.json())
    .then(result => {
        const messageArea = document.getElementById('messageArea');
        messageArea.textContent = result.message;
        messageArea.style.display = 'block'; // Show the message area
        document.getElementById('modal').style.display = 'none'; // Close the modal after booking
        fetchSlots(date); // Refresh the slots to reflect the booked status
    })
    .catch(error => {
        console.error('Error booking the slot:', error);
    });
}

function showModal() {
    document.getElementById('modal').style.display = 'block';
}

document.getElementsByClassName('close')[0].onclick = function() {
    document.getElementById('modal').style.display = 'none';
}

window.onclick = function(event) {
    if (event.target == document.getElementById('modal')) {
        document.getElementById('modal').style.display = 'none';
    }
}
function displayMessage(message) {
    const messageArea = document.getElementById('messageArea');
    messageArea.textContent = message;
    messageArea.style.display = 'block'; // Show the message area

    setTimeout(function() {
        messageArea.style.display = 'none'; // Hide the message area after 3 seconds
    }, 3000);
}
</script>
</body>
</html>
document.getElementById('appointmentForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting the traditional way

    // Gather form data
    const formData = new FormData(this);
    const data = new URLSearchParams(formData);

    // Fetch API to send the form data to 'book_appointment.php'
    fetch('book_appointment.php', {
        method: 'POST',
        body: data,
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch((error) => {
        console.error('Error:', error);
    });
});
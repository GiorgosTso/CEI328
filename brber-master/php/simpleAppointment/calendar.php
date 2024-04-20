<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bootstrap Calendar</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .calendar-day {
            height: 100px;
            border: 1px solid #dee2e6;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .text-muted {
            color: #6c757d; /* Bootstrap muted text color */
        }
    </style>
</head>
<body>
<div class="container mt-5">
    <div class="row mb-2">
        <div class="col text-center">
            <h2 id="monthYear"></h2>
        </div>
    </div>
    <div class="row">
        <div class="col text-right">
            <button class="btn btn-primary mb-3" onclick="moveMonth(-1)">&lt; Prev</button>
            <button class="btn btn-primary mb-3" onclick="moveMonth(1)">Next &gt;</button>
        </div>
    </div>
    <div class="row d-none d-sm-flex p-1 bg-dark text-white">
        <div class="col p-1 text-center">Sun</div>
        <div class="col p-1 text-center">Mon</div>
        <div class="col p-1 text-center">Tue</div>
        <div class="col p-1 text-center">Wed</div>
        <div class="col p-1 text-center">Thu</div>
        <div class="col p-1 text-center">Fri</div>
        <div class="col p-1 text-center">Sat</div>
    </div>
    <div id="calendar"></div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();

    function renderCalendar() {
        const monthDays = new Date(currentYear, currentMonth + 1, 0).getDate();
        const startDay = new Date(currentYear, currentMonth, 1).getDay();
        const prevMonthDays = new Date(currentYear, currentMonth, 0).getDate();
        
        document.getElementById('monthYear').textContent = new Date(currentYear, currentMonth).toLocaleDateString('en-us', { month: 'long', year: 'numeric' });
        const calendarDiv = document.getElementById('calendar');
        calendarDiv.innerHTML = '';

        let daysHTML = '<div class="row">';
        for (let i = startDay - 1; i >= 0; i--) {
            daysHTML += `<div class="col p-1 calendar-day text-muted">${prevMonthDays - i}</div>`;
        }

        for (let day = 1; day <= monthDays; day++) {
            daysHTML += `<div class="col p-1 calendar-day">${day}</div>`;
            if ((day + startDay) % 7 === 0 && day < monthDays) {
                daysHTML += '</div><div class="row">';
            }
        }

        const lastDay = (startDay + monthDays) % 7;
        if (lastDay !== 0) {
            for (let i = 1; i <= 7 - lastDay; i++) {
                daysHTML += `<div class="col p-1 calendar-day text-muted">${i}</div>`;
            }
        }

        daysHTML += '</div>';
        calendarDiv.innerHTML = daysHTML;
    }

    function moveMonth(step) {
        currentMonth += step;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        } else if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar();
    }

    renderCalendar();
</script>
</body>
</html>

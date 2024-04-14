<?php 
 include "../php/config.php";
$currentDate = date('Y-m-d');
$thirtyDaysAgoDate = date('Y-m-d', strtotime('-6 months'));

$sql = "SELECT SUM(amount_paid) AS totalMoney, MONTH(order_date) AS month, YEAR(order_date) AS year
        FROM orders
        WHERE order_date BETWEEN '$thirtyDaysAgoDate' AND '$currentDate'
        GROUP BY YEAR(order_date), MONTH(order_date)
        ORDER BY YEAR(order_date), MONTH(order_date) ASC";
        
        $sql1 = "SELECT COUNT(id) AS amountApp, MONTH(date) AS month, YEAR(date) AS year
        FROM appointments
        WHERE date BETWEEN '$thirtyDaysAgoDate' AND '$currentDate'
        GROUP BY YEAR(date), MONTH(date)
        ORDER BY YEAR(date), MONTH(date) ASC";

$fire = mysqli_query($conn, $sql);
$dataPoints = [];

$fire1 = mysqli_query($conn, $sql1);
$dataPoints1 = [];

while ($result = mysqli_fetch_assoc($fire)) {
    $dateObj = DateTime::createFromFormat('!m', $result['month']);
    $monthName = $dateObj->format('F'); // Convert month number to month name
    $formattedDate = $monthName . " '" . substr($result['year'], 2); // e.g., "Mar '21"

    $dataPoints[] = ["label" => $formattedDate, "y" => (float)$result['totalMoney']];
}

while ($result1 = mysqli_fetch_assoc($fire1)) {
    $dateObj1 = DateTime::createFromFormat('!m', $result1['month']);
    $monthName = $dateObj1->format('F'); // Convert month number to month name
    $formattedDate1 = $monthName . " '" . substr($result1['year'], 2); // e.g., "Mar '21"

    $dataPoints1[] = ["label" => $formattedDate1, "y" => (float)$result1['amountApp']];
}
?>

<script>
window.onload = function () {
    var chart = new CanvasJS.Chart("lineChartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Monthly Sales Over the Last 6 Months"
        },
        axisY: {
            title: "Total Money"
        },
        axisX: {
            title: "Date",
            interval: 1,
            intervalType: "month", // Adjusted for monthly data
            valueFormatString: "MMM YY" // Adjust if needed, based on your label formatting
        },
        data: [{
            type: "line",
            yValueFormatString: "#,##0.##",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("areaChartCanvas", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Monthly Contributions Over the Last 10 Months"
        },
        axisY: {
            title: "Total Money"
        },
        axisX: {
            title: "Date",
            interval: 1,
            intervalType: "month", // Adjusted for monthly data
            valueFormatString: "MMM YY" // Adjust if needed, based on your label formatting
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.##",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
    
    var chart = new CanvasJS.Chart("areaChartCanvas", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Monthly Contributions Over the Last 10 Months"
        },
        axisY: {
            title: "Amount Appointment"
        },
        axisX: {
            title: "Date",
            interval: 1,
            intervalType: "month", // Adjusted for monthly data
            valueFormatString: "MMM YY" // Adjust if needed, based on your label formatting
        },
        data: [{
            type: "column",
            yValueFormatString: "#,##0.##",
            dataPoints: <?php echo json_encode($dataPoints1, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}
</script>
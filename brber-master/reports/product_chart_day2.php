<?php include "../php/config.php";

$currentDate = date('Y-m-d');
$thirtyDaysAgoDate = date('Y-m-d', strtotime('-30 days'));

// SQL Query
$sql = "SELECT SUM(amount_paid) AS totalMoney, DAY(order_date) AS day, MONTH(order_date) AS month, YEAR(order_date) AS year
        FROM orders
        WHERE order_date BETWEEN '$thirtyDaysAgoDate' AND '$currentDate'
        GROUP BY YEAR(order_date), MONTH(order_date), DAY(order_date)
        ORDER BY YEAR(order_date), MONTH(order_date), DAY(order_date) ASC";
        
        $sql1 = "SELECT COUNT(id) AS amountApp, DAY(date) AS day, MONTH(date) AS month, YEAR(date) AS year
        FROM appointments
        WHERE date BETWEEN '$thirtyDaysAgoDate' AND '$currentDate'
        GROUP BY YEAR(date), MONTH(date), DAY(date)
        ORDER BY YEAR(date), MONTH(date), DAY(date) ASC";

// Execute query
$fire = mysqli_query($conn, $sql);
$dataPoints = [];

$fire1 = mysqli_query($conn, $sql1);
$dataPoints1 = [];

// Fetch results
while ($result = mysqli_fetch_assoc($fire)) {
    $dateObj = DateTime::createFromFormat('!m', $result['month']);
    $monthName = $dateObj->format('l'); // Convert month number to month name
    $formattedDate = $monthName . ' ' . $result['day'] . ", '" . substr($result['year'], 0);

    // Append the formatted date and total contribution to the dataPoints array
    $dataPoints[] = ["label" => $formattedDate, "y" => (float)$result['totalMoney']];
}

while ($result1 = mysqli_fetch_assoc($fire1)) {
    $dateObj = DateTime::createFromFormat('!m', $result1['month']);
    $monthName = $dateObj->format('l'); // Convert month number to month name
    $formattedDate1 = $monthName . ' ' . $result1['day'] . ", '" . substr($result1['year'], 0);

    // Append the formatted date and total contribution to the dataPoints array
    $dataPoints1[] = ["label" => $formattedDate1, "y" => (float)$result1['amountApp']];
}

?>

<script>
    window.onload = function () {
    var chart = new CanvasJS.Chart("lineChartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Daily Sales Over the Last 30 Days"
        },
        axisY: {
            title: "Total Money"
        },
        axisX: {
            title: "Date",
            interval: 1,
            intervalType: "day",
            valueFormatString: "MMM DD"
        },
        data: [{
            type: "line", // Changed from "column" to "line"
            yValueFormatString: "#,##0.##",
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();

    var chart = new CanvasJS.Chart("areaChartCanvas", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Daily Contributions Over the Last 30 Days"
        },
        axisY: {
            title: "Amount Appointment"
        },
        axisX: {
            title: "Date",
            interval: 1,
            intervalType: "day",
            valueFormatString: "MMM DD"
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

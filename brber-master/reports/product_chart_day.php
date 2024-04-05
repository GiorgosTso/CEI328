<?php include "../php/config.php";

$currentDate = date('Y-m-d');
$thirtyDaysAgoDate = date('Y-m-d', strtotime('-30 days'));

// SQL Query
$sql = "SELECT SUM(amount_paid) AS totalMoney, DAY(order_date) AS day, MONTH(order_date) AS month, YEAR(order_date) AS year
        FROM orders
        WHERE order_date BETWEEN '$thirtyDaysAgoDate' AND '$currentDate'
        GROUP BY YEAR(order_date), MONTH(order_date), DAY(order_date)
        ORDER BY YEAR(order_date), MONTH(order_date), DAY(order_date) ASC";

// Execute query
$fire = mysqli_query($conn, $sql);
$dataPoints = [];

// Fetch results
while ($result = mysqli_fetch_assoc($fire)) {
    $dateObj = DateTime::createFromFormat('!m', $result['month']);
    $monthName = $dateObj->format('l'); // Convert month number to month name
    $formattedDate = $monthName . ' ' . $result['day'] . ", '" . substr($result['year'], 0);

    // Append the formatted date and total contribution to the dataPoints array
    $dataPoints[] = ["label" => $formattedDate, "y" => (float)$result['totalMoney']];
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
            title: "Total Money"
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
            dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
        }]
    });
    chart.render();
}
</script>

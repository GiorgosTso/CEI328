<?php 
include "../php/config.php";

$currentDate = date('Y-m-d');
$threeYearsAgoDate = date('Y-m-d', strtotime('-3 years')); // Corrected variable name for clarity

// Adjusted SQL Query to Group by Year Only
$sql = "SELECT SUM(amount_paid) AS totalMoney, YEAR(order_date) AS year
        FROM orders
        WHERE order_date BETWEEN '$threeYearsAgoDate' AND '$currentDate'
        GROUP BY YEAR(order_date)
        ORDER BY YEAR(order_date) ASC";
        
        $sql1 = "SELECT COUNT(id) AS amountApp, YEAR(date) AS year
        FROM appointments
        WHERE date BETWEEN '$threeYearsAgoDate' AND '$currentDate'
        GROUP BY YEAR(date)
        ORDER BY YEAR(date) ASC";

$fire = mysqli_query($conn, $sql);
$dataPoints = [];

$fire1 = mysqli_query($conn, $sql1);
$dataPoints1 = [];

// Fetch results
while ($result = mysqli_fetch_assoc($fire)) {
    $formattedYear = $result['year']; // Simply use the year

    // Append the year and total sales to the dataPoints array
    $dataPoints[] = ["label" => $formattedYear, "y" => (float)$result['totalMoney']];
}

while ($result1 = mysqli_fetch_assoc($fire1)) {
    $formattedYear1 = $result1['year']; // Simply use the year

    // Append the year and total sales to the dataPoints array
    $dataPoints1[] = ["label" => $formattedYear1, "y" => (float)$result1['amountApp']];
}
?>

<script>
window.onload = function () {
    var chart = new CanvasJS.Chart("lineChartContainer", {
        animationEnabled: true,
        theme: "light2",
        title: {
            text: "Yearly Sales Over the Last 3 Years"
        },
        axisY: {
            title: "Total Sales"
        },
        axisX: {
            title: "Year",
            interval: 1,
            intervalType: "year",
            valueFormatString: "YYYY" // Format as full year
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
            text: "Daily Contributions Over the Last 30 Days"
        },
        axisY: {
            title: "Amount Appointment"
        },
        axisX: {
            title: "Year",
            interval: 1,
            intervalType: "year",
            valueFormatString: "YYYY"
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

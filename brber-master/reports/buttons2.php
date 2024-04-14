<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4">Dashboard</h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <!-- Dropdown for selecting report type -->
            <div class="mb-4">
                <label for="reportType" class="form-label"><strong>Select Report Type:</strong></label>
                <select class="form-select" id="reportType" onchange="redirectToReport(this.value);">
                    <option value="orders">Orders</option>
                    <option value="services">Services</option>
                </select>
            </div>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Per Day</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="chart2_day.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">Per Month</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="chart2_month.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">Per Year</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="chart2_year.php">View Details</a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var currentPage = window.location.pathname.split("/").pop();

                    // Set the dropdown value based on the current page
                    if (currentPage.startsWith("chart2_")) {
                        document.getElementById('reportType').value = 'services';
                    } else {
                        document.getElementById('reportType').value = 'orders';
                    }
                });

                function redirectToReport(reportType) {
                    var currentPage = window.location.pathname.split("/").pop();
                    var targetPage = (reportType === 'orders') ? 'chart_day.php' : 'chart2_day.php';

                    // Redirect to the correct 'day' page based on report type selection
                    if ((reportType === 'orders' && !currentPage.startsWith("chart_")) ||
                        (reportType === 'services' && !currentPage.startsWith("chart2_"))) {
                        window.location.href = targetPage;
                    }
                }
            </script>
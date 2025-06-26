<?php
// chart.php

// 1) Database connection
date_default_timezone_set('Asia/Kolkata');  // Set this to your correct timezone
$con = mysqli_connect("localhost", "root", "", "ebook");
if (!$con) {
    die("DB connection failed: " . mysqli_connect_error());
}

// 2) Read inputs
$period    = $_GET['timeperiod']  ?? 'overall';
$startDate = $_GET['start_date']  ?? '';
$endDate   = $_GET['end_date']    ?? '';

// If both dates are set, switch to 'range'
if ($startDate !== '' && $endDate !== '') {
    $period = 'range';
}

$labels     = [];
$ordersMap  = [];
$revenueMap = [];

// 3) Build labels & SQL per period
switch ($period) {

    // — Range: custom date range —
    case 'range':
        $start = new DateTime($startDate);
        $end   = new DateTime($endDate);
        $end->modify('+1 day');  // to include endDate
        $interval   = new DateInterval('P1D');
        $periodIter = new DatePeriod($start, $interval, $end);

        foreach ($periodIter as $dt) {
            $label = $dt->format('Y-m-d');
            $labels[]       = $label;
            $ordersMap[$label]  = 0;
            $revenueMap[$label] = 0;
        }

        $query = "
            SELECT 
                DATE(purchase_date) AS period_label,
                COUNT(*)            AS total_orders,
                SUM(amount_paid)    AS total_revenue
            FROM purchase
            WHERE purchase_date BETWEEN '{$startDate} 00:00:00' AND '{$endDate} 23:59:59'
            GROUP BY DATE(purchase_date)
            ORDER BY DATE(purchase_date) ASC
        ";
        break;

    // — Daily: last 7 days (including today) —
    case 'daily':
        // Ensure labels for 7 days, including today
        for ($i = 6; $i >= 0; $i--) {
            $d = date('Y-m-d', strtotime("-{$i} days"));
            $labels[]       = $d;
            $ordersMap[$d]  = 0;
            $revenueMap[$d] = 0;
        }
    
        $query = "
            SELECT 
                DATE(purchase_date) AS period_label,
                COUNT(*)            AS total_orders,
                SUM(amount_paid)    AS total_revenue
            FROM purchase
            WHERE purchase_date BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
            GROUP BY DATE(purchase_date)
            ORDER BY DATE(purchase_date) ASC
        ";
        break;

    // — Weekly: Weeks 1–4 of the current month —
    case 'weekly':
        $currentYear  = date('Y');
        $currentMonth = date('m');
        $monthName    = date('F');

        for ($w = 1; $w <= 4; $w++) {
            $label = "Week {$w} - {$monthName}";
            $labels[]         = $label;
            $ordersMap[$label]  = 0;
            $revenueMap[$label] = 0;
        }

        $query = "
            SELECT
                CEIL(DAY(purchase_date)/7) AS week_number,
                COUNT(*)                   AS total_orders,
                SUM(amount_paid)           AS total_revenue
            FROM purchase
            WHERE YEAR(purchase_date)  = {$currentYear}
              AND MONTH(purchase_date) = {$currentMonth}
            GROUP BY week_number
            ORDER BY week_number ASC
        ";
        break;

    // — Monthly: All 12 months of the current year —
    case 'monthly':
        $currentYear = date('Y');
        for ($m = 1; $m <= 12; $m++) {
            $name = date('F', mktime(0,0,0,$m,10));
            $labels[]         = $name;
            $ordersMap[$name]  = 0;
            $revenueMap[$name] = 0;
        }

        $query = "
            SELECT
                MONTH(purchase_date)    AS month_number,
                COUNT(*)                AS total_orders,
                SUM(amount_paid)        AS total_revenue
            FROM purchase
            WHERE YEAR(purchase_date) = {$currentYear}
            GROUP BY month_number
            ORDER BY month_number ASC
        ";
        break;

    // — Overall: All time —
    default:
        $labels[] = 'All Time';
        $ordersMap['All Time']  = 0;
        $revenueMap['All Time'] = 0;

        $query = "
            SELECT
                COUNT(*)         AS total_orders,
                SUM(amount_paid) AS total_revenue
            FROM purchase
        ";
        break;
}

// 4) Execute the query and map results back into your labels
$result = mysqli_query($con, $query);
if (!$result) {
    die("Query failed: " . mysqli_error($con));
}

while ($row = mysqli_fetch_assoc($result)) {
    switch ($period) {
        case 'range':
        case 'daily':
            $label = $row['period_label'];
            break;
        case 'weekly':
            // needs to match how we pre-built $labels
            $label = 'Week ' . $row['week_number'] . ' - ' . date('F');
            break;
        case 'monthly':
            $label = date('F', mktime(0,0,0,$row['month_number'],10));
            break;
        default: // overall
            $label = 'All Time';
            break;
    }

    if (isset($ordersMap[$label])) {
        $ordersMap[$label]  = (int)   $row['total_orders'];
        $revenueMap[$label] = (float) $row['total_revenue'];
    }
}

// 5) Build the final arrays for Chart.js
$orders  = [];
$revenue = [];
foreach ($labels as $lbl) {
    $orders[]  = $ordersMap[$lbl];
    $revenue[] = $revenueMap[$lbl];
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Chart Report</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        .chart-container {
            display: flex;
            gap: 30px;
            padding: 30px;
            justify-content: center;
        }
        .chart-box {
            width: 45%;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="chart-container">
        <div class="chart-box">
            <h4>Revenue Report (<?php echo ($period); ?>)</h4>
            <canvas id="revenueChart"></canvas>
        </div>
        <div class="chart-box">
            <h4>Orders Report (<?php echo ($period); ?>)</h4>
            <canvas id="ordersChart"></canvas>
        </div>
    </div>

    <script>
    const labels  = <?php echo json_encode($labels); ?>;
    const orders  = <?php echo json_encode($orders); ?>;
    const revenue = <?php echo json_encode($revenue); ?>;

    new Chart(document.getElementById('revenueChart'), {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Revenue (₹)',
                data: revenue,
                borderColor: 'rgba(75, 192, 192, 1)',
                backgroundColor: 'rgba(75, 192, 192, 0.3)',
                fill: true,
                tension: 0.3
            }]
        },
        options: { responsive: true }
    });

    new Chart(document.getElementById('ordersChart'), {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Orders',
                data: orders,
                backgroundColor: 'rgba(255, 99, 132, 0.5)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: { responsive: true }
    });
    </script>
</body>
</html>
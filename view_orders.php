<?php
session_start();
include("configuration.php");
include("admin_sidebar2.php");
$timePeriod = 'overall';
$timePeriod = $_GET['timeperiod'] ?? 'overall';
echo $timePeriod;
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;
$tickerClass = "ticker-bar success";
$tickerMessage = '';

if (!empty($startDate) && !empty($endDate)) {
    if (strtotime($startDate) > strtotime($endDate)) {
        // Invalid range: start after end
        $tickerClass = "ticker-bar error";
        $tickerMessage = "⚠️Start date must be before or equal to end date.";
        // Skip the rest of the processing
        $query = null;
        $headings = [];
    } else {
        $query = "SELECT purchase.purchase_id, system_user.full_name, books.title, purchase.amount_paid, purchase.purchase_date 
              FROM purchase 
              JOIN system_user ON purchase.user_id = system_user.id 
              JOIN books ON purchase.book_id = books.book_id 
              WHERE DATE(purchase_date) BETWEEN '$startDate' AND '$endDate' 
              ORDER BY purchase_date DESC";

        $headings = ['Purchase ID', 'User Info', 'Book', 'Amount Paid', 'Purchase Date'];
    }
}
// Otherwise, fall back to timeperiod logic
else {
    switch ($timePeriod) {

        // Daily report: last 7 days (including today)
        case 'daily':
            $query = "
                SELECT 
                    purchase_date AS day,
                    COUNT(*) AS total_orders,
                    SUM(amount_paid) AS total_revenue
                FROM purchase
                WHERE purchase_date BETWEEN CURDATE() - INTERVAL 6 DAY AND CURDATE()
                GROUP BY purchase_date
                ORDER BY day ASC
            ";
            $headings = ['Date', 'Total Orders', 'Total Revenue'];
            break;

        // Weekly report: current month's weeks (Week 1–4)
        case 'weekly':
            $currentYear = date('Y');
            $currentMonth = date('m');
            $query = "
                    SELECT 
                        CEIL(DAY(purchase_date)/7) AS week_number,
                        MIN(purchase_date)        AS week_start,
                        MAX(purchase_date)        AS week_end,
                        COUNT(*)                  AS total_orders,
                        SUM(amount_paid)          AS total_revenue
                    FROM purchase
                    WHERE YEAR(purchase_date)  = {$currentYear}
                      AND MONTH(purchase_date) = {$currentMonth}
                    GROUP BY week_number
                    ORDER BY week_number ASC
                ";
            $headings = ['Week Number', 'Week Start', 'Week End', 'Total Orders', 'Total Revenue'];
            break;

        // Monthly report: all 12 months of current year
        case 'monthly':
            $currentYear = date('Y');
            $query = "
                    SELECT 
                        MONTH(purchase_date)    AS month_number,
                        MONTHNAME(purchase_date) AS month_name,
                        COUNT(*)                AS total_orders,
                        SUM(amount_paid)        AS total_revenue
                    FROM purchase
                    WHERE YEAR(purchase_date) = {$currentYear}
                    GROUP BY month_number
                    ORDER BY month_number ASC
                ";
            $headings = ['Month Number', 'Month', 'Total Orders', 'Total Revenue'];
            break;

        // Default: all-time purchases
        default:
            $query = "
                    SELECT 
                        p.purchase_id,
                        u.full_name    AS user,
                        b.title        AS book,
                        p.amount_paid,
                        p.purchase_date
                    FROM purchase p
                    JOIN system_user u ON p.user_id = u.id
                    JOIN books b       ON p.book_id = b.book_id
                    ORDER BY p.purchase_date DESC
                ";
            $headings = ['Purchase ID', 'User', 'Book', 'Amount Paid', 'Purchase Date'];
            break;

    }
}






if (!empty($startDate) && !empty($endDate) && strtotime($startDate) <= strtotime($endDate)) {
    $sql = "SELECT COUNT(*) AS total_orders, SUM(amount_paid) AS total_revenue
                FROM purchase
                WHERE DATE(purchase_date) BETWEEN '$startDate' AND '$endDate'";
} else {
    // No range → use $period (daily/weekly/monthly/overall)
    switch ($timePeriod) {
        case 'daily':
            // Last 7 days
            $sql = "
              SELECT 
                COUNT(*)       AS total_orders,
                SUM(amount_paid) AS total_revenue
              FROM purchase
              WHERE purchase_date >= CURDATE() - INTERVAL 6 DAY
            ";
            break;

        case 'weekly':
            // Current month
            $yr = date('Y');
            $mon = date('m');
            $sql = "
              SELECT 
                COUNT(*)       AS total_orders,
                SUM(amount_paid) AS total_revenue
              FROM purchase
              WHERE YEAR(purchase_date) = {$yr}
                AND MONTH(purchase_date)= {$mon}
            ";
            break;

        case 'monthly':
            // Current year
            $yr = date('Y');
            $sql = "
              SELECT 
                COUNT(*)       AS total_orders,
                SUM(amount_paid) AS total_revenue
              FROM purchase
              WHERE YEAR(purchase_date) = {$yr}
            ";
            break;

        default:
            // Overall / all time
            $sql = "
              SELECT 
                COUNT(*)       AS total_orders,
                SUM(amount_paid) AS total_revenue
              FROM purchase
            ";
            break;
    }
}

// Run it and build the ticker
if ($query != '') {
    $tickerRes = mysqli_query($con, $sql);
    $tickerData = mysqli_fetch_assoc($tickerRes);
    $totalOrders = (int) $tickerData['total_orders'];
    $totalRevenue = (float) $tickerData['total_revenue'];

    $tickerMessage = "<span>
  Total Orders: {$totalOrders} | Total Revenue: ₹{$totalRevenue}
</span>";
}
?>
<!-- <div>
    <h1 style=""><?php echo $totalRevenue; ?></h1>
</div> -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Management</title>
    <link rel="stylesheet" href="view_book.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="view_orders.css?v=<?php echo time(); ?>">


    <style>
        .main-content {
            margin-left: 0;
            margin-left: -20px;
            width: 100%;
            /* overflow-wrap: break-word; */
        }
    </style>
</head>

<body>
    <div class="main-content2">
        <center>
            <i>
                <h2 class="heading_name">Order Management Center</h2>
            </i>
        </center>

        <!-- Filter Section -->
        <form method="get" class="filters">
            <div>
                <label for="status">Filter by Status: </label>
                <select id="status" name="timeperiod">
                    <option value="overall" <?php echo $timePeriod === 'overall' ? 'selected' : '' ?>>Overall</option>
                    <option value="daily" <?php echo $timePeriod === 'daily' ? 'selected' : '' ?>>Daily</option>
                    <option value="weekly" <?php echo $timePeriod === 'weekly' ? 'selected' : '' ?>>Weekly</option>
                    <option value="monthly" <?php echo $timePeriod === 'monthly' ? 'selected' : '' ?>>Monthly</option>
                </select>

            </div>
            <div>
                <label for="date-range">Select Date Range: </label>
                <input type="date" id="start-date" name="start_date"
                    value="<?php echo htmlspecialchars($startDate); ?>">
                <input type="date" id="end-date" name="end_date" value="<?php echo htmlspecialchars($endDate); ?>">
            </div>
            <button type="submit" class="report-btn">Generate Report</button>

        </form>

        <!-- Display Overall Totals -->

        <div class="chart-wrapper">
            <iframe
                src="chart-data.php?timeperiod=<?php echo urlencode($timePeriod); ?>&start_date=<?php echo urlencode($startDate); ?>&end_date=<?php echo urlencode($endDate); ?>"
                style="width:100%; height: 400px; border:none;"></iframe>
        </div>
        <!-- Display the Table -->
        <div class="book-table-wrapper">
            <table class="book-table3">
                <tr>
                    <?php
                    // Display dynamic headings
                    foreach ($headings as $heading) {
                        echo "<th>$heading</th>";
                    }
                    ?>
                </tr>

                <?php
                if ($query != '') {
                    // Query result
                    $result = mysqli_query($con, $query);

                    // Loop through the query results and generate table rows dynamically
                    if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<tr>";
                            foreach ($row as $value) {
                                echo "<td>$value</td>";
                            }
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='" . count($headings) . "'>No data found for this period.</td></tr>";
                    }
                }
                ?>
            </table>
        </div>

        <div class="<?php echo $tickerClass; ?>">
            <div class="ticker-content">
                <?php echo $tickerMessage; ?>
            </div>
        </div>
    </div>
</body>

</html>
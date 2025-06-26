<?php
include("configuration.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Orders</title>
    <link rel="stylesheet" href="view_book.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <?php
    $query = "SELECT purchase.*, books.title, books.book_img FROM purchase 
              JOIN books ON purchase.book_id = books.book_id 
              WHERE purchase.user_id = " . $_SESSION['id'] .
        " ORDER BY purchase.purchase_date DESC, purchase.purchase_id DESC";
    $result = mysqli_query($con, $query);
    $count = mysqli_num_rows($result);
    ?>
    <center>
        <i><h2 class="heading_name"><i class="fa-solid fa-cart-shopping"></i> My Orders - (<?php echo $count ?>) </h2></i>
    </center>



    <div class="book-table-wrapper">
        <table class="book-table">
            <tr>
                <th>PURCHASE ID</th>
                <th>BOOK TITLE</th>
                <th>AMOUNT PAID</th>
                <th>PURCHASE DATE</th>
                <th>DOWNLOAD</th>
            </tr>

            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row1 = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row1['purchase_id'] . "</td>";
                    echo "<td><img src='images/" . $row1['book_img'] . "' style='width:40px; height:40px;'><br>" . 
                    $row1['title'] . "</td>";
                    echo "<td>" . $row1['amount_paid'] . "</td>";
                    echo "<td>" . $row1['purchase_date'] . "</td>";
                    echo "<td><a href='download_book.php?purchase_id=" . $row1['purchase_id'] . "'>Download</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No purchase found.</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>
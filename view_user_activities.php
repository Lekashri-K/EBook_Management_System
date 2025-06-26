<?php
session_start();
include("configuration.php");
include("admin_sidebar2.php");
?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
    <link rel="stylesheet" href="view_book.css?v=<?php echo time(); ?>">
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
    <div class="main-content">
        <center>
            <i class="heading_name">
                <h2 style="margin-top:-15px">User Activity Management Center</h2>
            </i>
        </center>
        <?php
        $sql = "select count(*) as total from contact_request";
        $sql_result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($sql_result); ?>
        <?php
        $query = "select * from contact_request order by id desc";
        $result = mysqli_query($con, $query);
        $count = mysqli_num_rows($result);
        ?>
        <i>
            <h3 style="margin-left:70px">Contact Request - (<?php echo $row['total'] ?>)</h3>
        </i>
        <div class="book-table-wrapper">
            <table class="book-table">
                <tr>
                    <th> CONTACT ID</th>
                    <th>CUSTOMER NAME</th>
                    <th>MOBILE NO</th>
                    <th>EMAIL</th>
                    <th>MESSAGE</th>
                    <th>DATE</th>
                </tr>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row1['id'] . "</td>";
                        echo "<td>" . $row1['name'] . "</td>";
                        echo "<td>" . $row1['mobileno'] . "</td>";
                        echo "<td>" . $row1['email'] . "</td>";
                        echo "<td>" . $row1['message'] . "</td>";
                        echo "<td>" . $row1['created_at'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No purchase found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <?php
        $query = "select website_review.* ,system_user.full_name,system_user.id ,system_user.name from website_review join system_user on website_review.user_id=system_user.id order by review_id desc";
         $result = mysqli_query($con, $query);
        ?>
        <?php
        $sql1 = "select count(*) as total from website_review";
        $sql_result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($sql_result1); ?>
        <i>
            <h3 style="margin-left:70px">Website Review - (<?php echo $row1['total'] ?>)</h3>
        </i>
        <div class="book-table-wrapper">
            <table class="book-table1">
                <tr>
                    <th> REVIEW ID</th>
                    <th>USER INFO</th>
                    <th>REVIEW</th>
                    <th>DATE</th>
                </tr>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row1['review_id'] . "</td>";
                        echo "<td>" . "#" . $row1['user_id'] . " &rarr; " . $row1['name'] . " (" . $row1['full_name'] . ")" . "</td>";
                        echo "<td>" . $row1['website_review'] . "</td>";
                        echo "<td>" . $row1['created_at'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No review found.</td></tr>";
                }
                ?>
            </table>
        </div>
        <?php
        $query = "select book_review.*,books.title,system_user.name,system_user.full_name from book_review 
     join books on book_review.book_id=books.book_id join system_user on system_user.id=book_review.user_id order by  review_id desc";
        $result = mysqli_query($con, $query);
        ?>
        <?php
        $sql2 = "select count(*) as total from book_review";
        $sql_result2 = mysqli_query($con, $sql2);
        $row2 = mysqli_fetch_assoc($sql_result2); ?>
        <i>
            <h3 style="margin-left:70px">Book Review - (<?php echo $row2['total'] ?>)</h3>
        </i>
        <div class="book-table-wrapper">
            <table class="book-table">
                <tr>
                    <th> REVIEW ID</th>
                    <th>USER INFO</th>
                    <th>BOOK</th>
                    <th>REVIEW</th>
                    <th>DATE</th>
                </tr>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row1['review_id'] . "</td>";
                        echo "<td>" . "#" . $row1['user_id'] . " &rarr; " . $row1['name'] . " (" . $row1['full_name'] . ")" . "</td>";
                        echo "<td>" . "#" . $row1['book_id'] . " &rarr; " . $row1['title'] . "</td>";
                        echo "<td>" . $row1['book_review'] . "</td>";
                        echo "<td>" . $row1['review_date'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No review found.</td></tr>";
                }
                ?>
            </table>
        </div>
    </div>

</body>

</html>
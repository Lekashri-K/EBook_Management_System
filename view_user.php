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
    <link rel="stylesheet" href="view_user.css?v=<?php echo time(); ?>">
    <style>
        .main-content {
            margin-left: 0;
            margin-left: -20px;
            width:100%;
            /* overflow-wrap: break-word; */
        }
    </style>
</head>

<body>
    <div class="main-content">
        <center>
            <i>
                <h2 class="heading_name"  style="margin-top:-15px">Registration Monitoring Panel</h2>
            </i>
        </center>
        <?php
        $sql = "select count(*) as total from system_user";
        $sql_result = mysqli_query($con, $sql);
        $row = mysqli_fetch_assoc($sql_result); ?>
        <h3 class="title">Total Registered Users - (<?php echo $row['total'] ?>)</h3>
        <?php
        $query = "select * from system_user order by id desc";
        $result = mysqli_query($con, $query);
        ?>

        <div class="book-table-wrapper">
            <table class="book-table1">
                <tr>
                    <th> USER ID</th>
                    <th>USER INFO</th>
                    <th>EMAIL</th>
                    <th>PASSWORD</th>
                    <th>ROLE</th>
                    <th>CONTACT NO</th>
                    <th>GENDER</th>
                    <th>REGISTRATION DATE</th>
                </tr>

                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>" . $row1['id'] . "</td>";
                        echo "<td>" . $row1['name'] . " (" . $row1['full_name'] . ")" . "</td>";
                        echo "<td>" . $row1['email'] . "</td>";
                        echo "<td>" . $row1['password'] . "</td>";
                        echo "<td>" . $row1['role'] . "</td>";
                        echo "<td>" . $row1['contact_number'] . "</td>";
                        echo "<td>" . $row1['gender'] . "</td>";
                        echo "<td>" . $row1['doj'] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No users found.</td></tr>";
                }
                ?>
            </table>
        </div>
</body>

</html>
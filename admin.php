<?php
session_start();
include "admin_sidebar.php"
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="admin.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <center>
        <div class="activity">
            <a href="add_book.php" style="text-decoration:none;color:black;font-size:18px">
                <div class="function">
                    <center>
                        <div class="plus"><i class="fa-solid fa-plus"></i></div>

                        <h4>Add Books</h4>
                        <p>---------------</p>
                    </center>
                </div>
            </a>
            <a href="add-category.php" style="text-decoration:none;color:black;font-size:18px">
                <div class="function">
                    <center>
                        <div class="cate"><i class="fa-solid fa-layer-group"></i></div>

                        <h4>Add Category</h4>
                        <p>---------------</p>
                    </center>
                </div>
            </a>
            <a href="view_books.php" style="text-decoration:none;color:black;font-size:18px">
                <div class="function">
                    <center>
                        <div class="books"><i class="fa-solid fa-book-open"></i></div>

                        <h4>All Books</h4>
                        <p>---------------</p>
                    </center>
                </div>
            </a>
            <a href="view_orders.php" style="text-decoration:none;color:black;font-size:18px">
                <div class="function">
                    <center>
                        <div class="order"><i class="fa-solid fa-box-open"></i></div>

                        <h4>Orders</h4>
                        <p>---------------</p>
                    </center>
                </div>
            </a>
        </div>
        <div class="activity1">
            <a href="view_user.php" style="text-decoration:none;color:black;font-size:18px">
                <div class="function1">
                    <center>
                        <div class="view_user"><i class="fa-solid fa-users"></i></div>

                        <h4>View Users</h4>
                        <p>---------------</p>
                    </center>
                </div>
            </a>
            <a href="view_user_activities.php" style="text-decoration:none;color:black;font-size:18px">
                <div class="function1">
                    <center>
                        <div class="user"><i class="fa-solid fa-user-check"></i></div>

                        <h4>User Activity</h4>
                        <p>---------------</p>
                    </center>
                </div>
            </a>
            <a href="logout.php" style="text-decoration:none;color:black;font-size:18px">
                <div class="function1">
                    <center>
                        <div class="logoutt"><i class="fa-solid fa-share-from-square"></i></div>

                        <h4>Logout</h4>
                        <p>---------------</p>
                    </center>
                </div>
            </a>

        </div>
        </div>
    </center>
</body>

</html>
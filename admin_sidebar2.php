<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <style>
        body {
            font-family: Arial, sans-serif;
            /* display: flex; */
        }

        .sidebar {
            z-index: 1500;
            margin-top: -20px;
            width: 270px;
            height: 100vh;
            background-color: #1c2541;
            color: white;
            /* padding-top: 20px; */
            position: fixed;
            transition: 0.6s ease;
            transition-property: left;
            left: -300px;
        }

        .sidebar.active {
            left: 0px;

        }

        .sidebar h2 {
            text-align: center;
            margin-top: 30px;
            margin-bottom: 30px;
            font-size: 24px;
            letter-spacing: 1px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar ul li {
            padding: 15px 20px;
            border-bottom: 1px solid #394867;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .sidebar ul li:hover {
            background-color: #3a506b;
        }

        .sidebar ul li a {
            color: white;
            text-decoration: none;
            display: block;
        }

        .main-content {
            margin-left: 100px;
            padding: 20px;
            flex: 1;

        }
      

        .close-btn {
            z-index: 1000;
            position: absolute;
            font-size: 23px;
            top: 0;
            right: 0;
            margin: 5px;
            cursor: pointer;
            /* padding-bottom: 50px; */

        }

        .menu {
            width: 100%;
            margin-top: 30px;
        }

        .menu-btn {
            z-index: 1500;
            position: absolute;
            font-size: 25px;
            cursor: pointer;
            /* margin: 25px; */
            margin-left: 15px;
            /* border-radius: 10px; */
        }

        .sidebar.active~.main-content {
            margin-left: 230px;
        }
        .sidebar.active~.main-content1{
            margin-left: 150px;
        }
        .sidebar.active~.main-content2{
            margin-left: 200px;
        }
    </style>


    <div class="menu-btn">
        <i class="fa-solid fa-bars"></i>
    </div>

    <div class="sidebar">
        <div class="close-btn">
            <i class="fa-solid fa-xmark"></i>
        </div>
        <h2 style="color:white">Admin Panel</h2>
        <ul>
            <li><a href="admin.php">Dashboard</a></li>
            <li><a href="add_book.php">Add Books</a></li>
            <li><a href="add-category.php">Add Category</a></li>
            <li><a href="view_books.php">All Books</a></li>
            <li><a href="view_orders.php">View Orders</a></li>
            <li><a href="view_user.php">View Users</a></li>
            <li><a href="view_user_activities.php">View User Activities</a></li>
            <li><a href="logout.php">Logout</a></li>
        </ul>
    </div>
    <script>

        // open menu button
        document.addEventListener("DOMContentLoaded", function () {
            const menuBtn = document.querySelector(".menu-btn");
            const sidebar = document.querySelector(".sidebar");

            menuBtn.addEventListener("click", function () {
                sidebar.classList.add("active");
                menuBtn.style.visibility = "visible";
            });

            //close button event
            const closeBtn = document.querySelector(".close-btn");
            closeBtn.addEventListener("click", function () {
                sidebar.classList.remove("active");
                menuBtn.style.visibility = "visible";
            });

        });
    </script>



</body>

</html>

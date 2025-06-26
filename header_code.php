<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="sidebar-design.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="header_style.css?v=<?php echo time(); ?>">
</head>
<body>
<div style="background-color:#5d4037;height:15px;">

</div>
<div class="header">
    <style>
        .signin {
            background-color: green;
            margin: 5px;
            padding: 5px;
            color: white;
            height: 20px;
            margin-top: -5px;
            border-radius: 8%;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .signin:hover {

            transform: scale(1.05);
        }

        .login {
            background-color: darkblue;
            margin: 5px;
            padding: 5px;
            color: white;
            height: 20px;
            margin-top: -5px;
            border-radius: 8%;
            text-decoration: none;
            display: inline-block;
            transition: transform 0.2s ease, filter 0.2s ease;

        }

        .logout {
            background-color: #c9302c;
            margin: 5px;
            padding: 8px;
            color: white;
            height: 20px;
            margin-top: 10px;
            border-radius: 50px;
            text-decoration: none;
            transition: transform 0.2s ease, filter 0.2s ease;
        }

        .logout:hover {
            background-color: #c9302c;
            box-shadow: 0px 0px 10px rgba(217, 83, 79, 0.8);
        }

        .login:hover {

            transform: scale(1.05);
        }

        /* .go-button {
            margin-left: 10px;
            background-color: #144250;
            margin: 5px;
            padding: 10px;
            color: white;
            border-radius: 8%;
            height: 15px;
            transition: transform 0.2s ease, filter 0.2s ease;
            
        } */
        .go-button {
            background-color: #144250;
            border-color: #144250;
            font-size: 12px;
            padding: 8px;
            color: white;
            border-radius: 8%;
            height: 34px;
            transition: transform 0.2s ease, filter 0.2s ease;
            margin-top: 11px;
        }

        .go-button:hover {
            transform: scale(1.05);
            filter: brightness(1.1);
        }
    </style>


    <div class="nav">
        <div>
            <img src="logo.jpeg" alt="image not found" width="60px" height="60px" class="logo" ;>
            </img>
        </div>
        <div class="heading">
            <i><b>E Book Galaxy</b></i>
        </div>
        <!-- <div class="size">
            <div>
                <input class="searchbar" placeholder="  Search by title name">

            </div>
            <div class="go">
                <h5 class="go-button">Search</h5>
            </div>
        </div> -->
        <div class="size">
            <form method="GET" action="search.php" style="display: flex;">
                <input class="searchbar" name="search" placeholder="  Search by title name" value="<?php if (isset($_GET['search']))
                    echo $_GET['search']; ?>">
                <button type="submit" class="go-button">Search</button>
            </form>
        </div>
        <div class="adjust">
            <style>
                .profile_pic:hover {
                    transform: scale(1.05);
                }
            </style>
            <?php
            if (!isset($_SESSION['name'])) {
                $_SESSION['redirect_back'] = $_SERVER['REQUEST_URI'];
            } else {
                $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
            }
            ?>

           

            <?php if (isset($_SESSION['name'])) {
                $query = "select full_name from system_user where id = $user_id";
                $result = mysqli_query($con, $query);
                $row = mysqli_fetch_assoc($result);
                $user_name = $row['full_name'];

                $first_letter = strtoupper(substr($user_name, 0, 1)); ?>
                <div style="width: 35px; height: 35px; background-color: #0f172a; color: white;
                                     border-radius: 50%; display: flex; align-items: center; justify-content: center;
                                       font-size: 18px;margin-top:13px;cursor:pointer" id="logout-btn"
                    class="profile_pic">
                    <?php echo $first_letter ?>
                </div>
                <h4><a href="logout.php" class="logout"><i class="fa-solid fa-user-plus fa-sm"
                            style="margin-right:5px"></i>Logout</a></h4>

            <?php } else { ?>
                <h4><a href="login.php" class="login"><i class="fa-solid fa-user-plus fa-sm"
                            style="margin-right:5px"></i>Login</a></h4>
                <h4><a href="register.php" class="signin"><i class="fa-solid fa-right-to-bracket fa-sm"
                            style="margin-right:5px"></i>Signup</a></h4>
            <?php } ?>

        </div>


    </div>

</div>
<div class="pages" style="display: flex; justify-content: space-between; align-items: center;">
    <div class="items" style="display:flex">
        <h3>
            <a href="index.php" style="color:white; text-decoration: none; margin-right:20px">
                <i class="fa-solid fa-house-chimney fa-sm"
                    style="color:white;margin-right:8px;margin-left:5px"></i>Home</a>
        </h3>
        <!-- <h3 style="margin-right:15px"><i class="fa-solid fa-list fa-sm" style="color:white;margin-right:8px"></i>Categories</h3> -->
        <h3>
            <a href="index.php#category-image" style="color:white; text-decoration: none; margin-right:20px;">
                <i class="fa-solid fa-list fa-sm" style="color:white;margin-right:8px;"></i>Categories</a>
        </h3>
        <h3>
            <a href="about.php" style="color:white; text-decoration: none; margin-right:20px">
                <i class="fa-solid fa-address-card fa-sm" style="color:white;margin-right:8px"></i>About Us</a>
        </h3>
        <h3>
            <a href="review.php" style="color:white; text-decoration: none; margin-right:20px"><i
                    class="fa-solid fa-magnifying-glass fa-sm" style="color:white;margin-right:8px"></i>Reviews</a>
        </h3>

    </div>
    <div class="contact" style="display:flex;margin-right:10px">
        <h4><i class="fa-solid fa-person-circle-question" style="color:black;margin-right:5px"></i><a
                href="help.php">Q&A Spot</a></h4>
        <h4><i class="fa-solid fa-user-tie" style="color:black;margin-right:5px"></i><a href="contact.php">Contact
                Us</a></h4>
    </div>
</div>
<div class="sidebar">
    <header>
        <div class="close-btn">
            <i class=" fa-solid fa-xmark fa-xs"></i>
        </div>
        <div class="img">
            <img src="profile1.jpeg">
        </div>
        <h4><?php
        if (isset($_SESSION['full_name'])) {
            ?>
                <center>
                    <h2 style="margin-top:-3px"><?php echo "Welcome " . htmlspecialchars($_SESSION['full_name']); ?></h2>
                </center>
            <?php } else {
            echo "Guest User";
        }
        ?>
        </h4>
    </header>

    <div class="menu">
        <div class="item">
            <a href="edit-profile.php">
                <i class="fa-solid fa-pencil"></i>
                Edit Profile
            </a>
        </div>

        <div class="item">
            <a href="password.php">
                <i class="fa-solid fa-key"></i>
                Change Password
            </a>
        </div>

        <div class="item">
            <a href="contact.php">
                <i class="fa-solid fa-circle-info"></i>
                Help and support
            </a>
        </div>

        <div class="item">
            <a href="my_orders.php">
                <i class="fa-solid fa-cart-shopping"></i>
                Order Details
            </a>
        </div>

        <div class="item">
            <a href="logout.php">
                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                Logout
            </a>
        </div>

    </div>
</div>

</body>
</html>
<script>

    // open menu button
    document.addEventListener("DOMContentLoaded", function () {
        const searchBtn = document.querySelector("#logout-btn");
        const sidebar = document.querySelector(".sidebar");

        searchBtn.addEventListener("click", function () {
            sidebar.classList.add("active");
            menuBtn.style.visibility = "hidden";
        });

        //close button event
        const closeBtn = document.querySelector(".close-btn");
        closeBtn.addEventListener("click", function () {
            sidebar.classList.remove("active");
            menuBtn.style.visibility = "hidden";
        });

    });
</script>

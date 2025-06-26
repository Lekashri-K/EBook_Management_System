<?php
session_start();
include("configuration.php");
$query = "select * from categories";
$result = mysqli_query($con, $query);
$categories = [];
while ($row = mysqli_fetch_array($result)) {
    $categories[] = $row;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="trial.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="sidebar-design.css?v=<?php echo time(); ?>">
</head>

<body style="background-color:white;">
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
                padding: 5px;
                color: white;
                height: 20px;
                margin-top: 10px;
                border-radius: 8%;
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

                <form method="POST" action="search.php" style="display: flex; ">
                    <input class="searchbar" name="search" placeholder="  Search by title name">
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
                    /*login pannama iruntha poi login pannitu athey page varathuku*/
                    $_SESSION['redirect_back'] = $_SERVER['REQUEST_URI'];
                } else {
                    /*login panni irukum bothu logout thotta athey page varathuku*/
                    $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
                }
                ?>

                <?php if (isset($_SESSION['name'])) { ?>
                    <img src="profile.jpeg" id="logout-btn" class="profile_pic"
                        style="width:40px;height:30px;border-radius:60%;margin-top:15px;margin-right:10px;cursor:pointer" />
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
                <a href="#category-image" style="color:white; text-decoration: none; margin-right:20px;">
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

    <div class="homepage-image">
        <div class="image-text">

            <h1><b style="font-size: larger;">Explore the books...!</b></h1>
            <h2><i style="font-size: larger" ;>Rediscover Yourself :)</i></h2>
            <p><i style="font-size:25px">
                    "Lots of eBooks available to explore!Immerse yourself in a world of endless stories! With a vast
                    collection of eBooks at your fingertips, explore new adventures, gain knowledge, and lose yourself
                    in
                    captivating reads—anytime, anywhere."

                </i></p>
        </div>

    </div>
    <?php
    $query = "select * from books order by downloads desc limit 6";
    $result = mysqli_query($con, $query);
    $books = [];
    while ($row = mysqli_fetch_array($result)) {
        $books[] = $row;
    }
    ?>
    <br>

    <h2 style="color:#1a0004;">Trending Books</h2><br>
    <hr><br>
    <div class="trending-container">
        <?php foreach ($books as $b) { ?>
            <div>
                <form action="" method="post">
                    <a href="book-details.php?book_id=<?php echo $b['book_id']; ?>">
                        <img src="<?php echo $b['book_img']; ?>" class="trending-size" />
                    </a>

                </form>

                <div class="trending-book-details">
                    <h3 style="font-size: 20px;"><?php echo $b['title']; ?></h3>
                    <p style="font-size:large;"><?php echo $b['author']; ?></p>
                    <p style="color:red; font-size:large"><?php echo $b['price']; ?></p>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>
    <?php
    $s_query = "select * from books order by book_id desc limit 6";
    $s_result = mysqli_query($con, $s_query);
    $s_books = [];
    while ($s_row = mysqli_fetch_array($s_result)) {
        $s_books[] = $s_row;
    }
    ?>
    <h2 style="color:#1a0004">Best Selling Books</h2><br>
    <hr><br>
    <div class="trending-container">
        <?php foreach ($s_books as $b) { ?>
            <div>
                <form action="" method="post">
                    <a href="book-details.php?book_id=<?php echo $b['book_id']; ?>">
                        <img src="<?php echo $b['book_img'] ?>" class="trending-size" />
                    </a>
                </form>
                <div class="trending-book-details">
                    <h3 style="font-size: 20px;"><?php echo $b['title'] ?></h3>
                    <p style="font-size:large;"><?php echo $b['author'] ?></p>
                    <p style="color:red; font-size:large"><?php echo $b['price'] ?></p>
                    </p>
                </div>
            </div>
        <?php } ?>
    </div>
    <br>

    <div id="category-image">
        <h2 style="color:#1a0004">Categories</h2>
        <br>
        <hr>

        <?php
        //  print_r($categories);
        // Loop through categories and create rows dynamically
        for ($i = 0; $i < count($categories); $i += 3) { ?>
            <div class="category-row">
                <?php


                for ($j = $i; $j < $i + 3 && $j < count($categories); $j++) {


                    ?>

                    <a style="text-decoration:none" href="books.php?category_id=<?php echo $categories[$j]['category_id']; ?>"
                        class="category-link">
                        <div class="r-image" style="background-image: url('<?php echo $categories[$j]['category_img']; ?>');">
                            <h1 class="category-name"><?php echo $categories[$j]['category_name']; ?></h1>
                        </div>
                    </a>
                <?php } ?>
            </div>
        <?php } ?>

    </div>

    <div class="footer">
        <div class="footerclass1">
            <a style="color:white;text-decoration:none" href="index.php">
                <h2><i>Home</i></h2>
            </a>
            <h3>Trending</h3>
            <h3>Best-Selling</h3>
            <h3>Categories</h3>
        </div>
        <div class="footerclass2">
            <a style="color:white;text-decoration:none" href="about.php">
                <h2><i>About Us</i></h2>
            </a>
            <h3>About our platform</h3>
            <h3>Why choose us</h3>
            <h3>4 steps to use</h3>
        </div>

        <div class="footerclass3">
            <a style="color:white;text-decoration:none" href="review.php">
                <h2><i>Review</i></h2>
            </a>
            <h3>User ratings</h3>
            <h3>User reviews</h3>
            <a style="color:white;text-decoration:none" href="help.php">
                <h3>Help</h3>
            </a>
        </div>
        <div class="footerclass4">
            <a style="color:white;text-decoration:none" href="contact.php">
                <h2><i>Contact us</i></h2>
            </a>
            <h3>+123-456-7890 <i class="fa-solid fa-phone"></i></h3>
            <h3>ebookgalaxy@gmail.com <i class="fa-solid fa-envelope"></i></h3>
            <h3>
                Main Street,Thanjavur <i class="fa-solid fa-location-dot"></i>
            </h3>
        </div>
    </div>
    <hr>
    <div class="final-footer">
        <div>
            <i class="fa-regular fa-copyright"></i> 2016 FutureMarketer private ltd.All Rights reserved.
        </div>
        <div>
            <i class="fa-brands fa-facebook" style="font-size: 30px;margin-left: 10px;color:aliceblue"></i>
            <i class="fa-brands fa-instagram" style="font-size: 30px;margin-left: 10px;color:aliceblue"></i>
            <i class="fa-brands fa-twitter" style="font-size: 30px;margin-left: 10px;color:aliceblue"></i>
            <i class="fa-brands fa-linkedin-in" style="font-size: 30px;margin-left: 10px;color:aliceblue"></i>
            <i class="fa-brands fa-youtube" style="font-size: 30px;margin-left: 10px;color:aliceblue"></i>
        </div>
        <div>
            Terms of Service
        </div>
        <div>
            Privacy Policy
        </div>
    </div>
</body>

</html>
<!-- <div class="menu-btn">
    <i class="fa-solid fa-bars"></i>

</div> -->

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


</body>

</html>
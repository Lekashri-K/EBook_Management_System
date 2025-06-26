<?php
ob_start();
session_start();
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];

}
include("configuration.php");
include("header_code.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="footer_code.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="b_details.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="sidebar-design.css">

</head>

<body style="background-color:white;">
    <?php
    if (isset($_GET['book_id'])) {

        $book_id = $_GET['book_id'];
        $query = " SELECT books.*, categories.category_name  
        FROM books  
        JOIN categories ON books.category_id = categories.category_id  
        WHERE books.book_id = $book_id";
        $result = mysqli_query($con, $query);

        $book_details = [];
        while ($book_row = mysqli_fetch_assoc($result)) {
            $book_details[] = $book_row;
        }

        // print_r($book_details);
    


    }
    ?>
    <div class="book-part">
        <div class="first-div">

            <div class="img-div">
                <img src="<?php echo $book_details[0]['book_img']; ?>" style="width:235px; height:355px;">
                <br>
                <form action="payment.php?id=<?php echo $book_id; ?>" method="post">
                    <button class="buy-btn" type="submit" style="cursor:pointer"><i class="fa-solid fa-bolt"></i> BUY
                        NOW</button>

                </form>

            </div>
            <div class="content">
                <h1 style="color:#0f172a;"><?php echo $book_details[0]['title']; ?>
                </h1>
                <i>

                    <p style="font-size:25px;margin-top:-15px;font-color:#3e2723;">
                        <?php echo $book_details[0]['author']; ?> (Author)
                    </p>
                </i>
                <!-- <div class="rate" style="margin-top:-5px">
                    <div>
                        <i class="fa-solid fa-trophy" style="margin-left:5px; font-size:30px; color:gold;margin-bottom:20px"></i>
                    </div>
                    <div style="margin-top:-30px;margin-left:20px">
                        <p style="font-size:20px;margin-top:30px;margin-left:-8px">Quality Content</p></i>

                    </div>

                </div> -->
                <p style="font-size:30px;margin-top:-10px;color:#b12704">₹<?php echo $book_details[0]['price']; ?></p>
                <p style="margin-top:-20px">(Inclusive of all taxes)</p>
                <p style="font-size:17px"><?php echo $book_details[0]['book_des']; ?>
                </p>

            </div>
        </div>

        <div class="second-div">
            <h2 style="padding-top:10px;margin-top:10px;color:#0f172a;">Book Specifications</h2>
            <div class="specifications" style="margin-top:-25px">
                <div class="column">
                    <dl>
                        <div class="spec-row">
                            <dt>Genre</dt>
                            <dd><?php echo $book_details[0]['category_name']; ?></dd>
                        </div>
                        <div class="spec-row">
                            <dt>Author</dt>
                            <dd><?php echo $book_details[0]['author']; ?></dd>
                        </div>
                        <div class="spec-row">
                            <dt>ISBN</dt>
                            <dd><?php echo $book_details[0]['isbn']; ?></dd>
                        </div>
                        <div class="spec-row">
                            <dt>Language</dt>
                            <dd>English</dd>
                        </div>
                    </dl>
                </div>
                <div class="column" style="margin-left:300px">
                    <dl>
                        <div class="spec-row">
                            <dt>Publisher</dt>
                            <dd><?php echo $book_details[0]['publisher']; ?></dd>
                        </div>
                        <div class="spec-row">
                            <dt>Published Date</dt>
                            <dd><?php echo $book_details[0]['published_date']; ?></dd>
                        </div>
                        <div class="spec-row">
                            <dt>Downloads</dt>
                            <dd><?php echo $book_details[0]['downloads']; ?></dd>
                        </div>
                        <div class="spec-row">
                            <dt>Pages</dt>
                            <dd><?php echo $book_details[0]['pages']; ?></dd>
                        </div>
                    </dl>
                </div>
            </div>
        </div>
        <div class="Third-div">
            <h2 style="padding-top:10px;margin-top:10px;color:#0f172a;">About The Author</h2>
            <div style="display:flex">
                <img src="<?php echo $book_details[0]['author_img']; ?>"
                    style="width:80px;height:80px;border-radius:60%;" />
                <div>
                    <h3 style="margin-left:20px"><?php echo $book_details[0]['author']; ?></h3>
                    <p style="font-size:18px;margin-left:20px;margin-top:-15px">
                        <?php echo $book_details[0]['total_books']; ?> Books</>
                </div>
            </div>


            <p style="font-size:17px;"><?php echo $book_details[0]['author_des']; ?></p>
        </div>
        <?php
        // $query = "select * from book_review where book_id=$book_id order by review_id desc ";
        // echo "$user_id";
        $query = "select book_review.*,system_user.full_name from book_review join system_user on book_review.user_id=system_user.id where book_id=$book_id order by review_id desc limit 3";
        $result = mysqli_query($con, $query);
        $review = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $review[] = $row;
        }

        // print_r($review);
        
        ?>

        <div class="sixth-div">
            <h2 style="padding-top:10px;margin-top:10px;color:#0f172a;">User Reviews</h2>
            <?php if (mysqli_num_rows($result) > 0) { ?>
                <?php foreach ($review as $r) {
                    $user_name = $r['full_name'];
                    $first_letter = strtoupper(substr($user_name, 0, 1)); ?>
                    <div style="margin-bottom:25px; border-bottom:1px solid #ccc; padding-bottom:10px;">
                        <div style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: flex; align-items: center;">
                                <div
                                    style="width: 35px; height: 35px; background-color: #0f172a; color: white; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-weight: bold; font-size: 16px;">
                                    <?php echo $first_letter ?>
                                </div>
                                <div style="margin-left: 10px; font-weight: bold; font-size: 18px;">
                                    <?php echo $r['full_name'] ?>
                                </div>
                            </div>
                            <div style="font-size: 14px; color: #555;"><?php echo $r['review_date'] ?></div>
                        </div>
                        <div style="margin-left: 45px; margin-top: 8px; font-size: 17px; color: #333;">
                            <?php echo $r['book_review'] ?>
                        </div>

                    </div>
                <?php } ?>
            <?php } else { ?>
                <div style="margin-top: 8px; font-size: 17px; color: #333;">
                    <?php echo "No reviews yet for this book." ?>
                </div>
            <?php } ?>

        </div>
        <div class="fourth-div">
            <h2 style="padding-top:10px;margin-top:10px;color:#0f172a;">People also enjoyed</h2>
            <?php
            $query = "select * from books order by downloads desc limit 5";
            $result = mysqli_query($con, $query);
            $books = [];
            while ($row = mysqli_fetch_array($result)) {
                $books[] = $row;
            }
            ?>
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

        </div>

        <div class="fifth-div" id="show">
            <h2 style="padding-top:10px;margin-top:10px;color:#0f172a;">Ratings & Reviews</h2>
            <center>

                <img src="book-logo.jpeg" style="width:80px;height:80px;border-radius:60%;" />
                <i>
                    <h1>What do you think?</h1>
                </i>
                <div style="justify-content:center">
                    <div style="display:flex;justify-content:center">
                        <div>
                            <div class="rate-stars">
                                <i class="fa-solid fa-star " style="margin-left:10px;font-size:20px"></i>
                                <i class="fa-solid fa-star " style="margin-left:10px;font-size:20px"></i>
                                <i class="fa-solid fa-star " style="margin-left:10px;font-size:20px"></i>
                                <i class="fa-solid fa-star " style="margin-left:10px;font-size:20px"></i>
                                <i class="fa-solid fa-star " style="margin-left:10px;font-size:20px"></i>
                            </div>

                            <p style="font-size:17px">Write your review with star count.</p>
                        </div>

                        <!-- <div style="margin-top:10px">
                        <button class="submit-btn" style="margin-top:-10px;font-size:17px;cursor:pointer"
                            onclick="toggleReviewBox()">Write a review</button>
                    </div> -->
                        <?php

                        if (isset($_POST['write_review'])) {
                            // If not logged in, redirect to login page
                            if (!isset($_SESSION['id'])) {
                                $_SESSION['redirect_back'] = $_SERVER['REQUEST_URI'];
                                header("Location:login.php");
                                exit();
                            } else {
                                // Allow showing the review box
                                $showReviewBox = true;
                            }
                        }

                        if (isset($_POST['submit_review'])) {
                            if (isset($_SESSION['id'])) {
                                $user_id = $_SESSION['id'];
                                $book_id = $book_details[0]['book_id'];// make sure your URL is like book-details.php?id=BOOK_ID
                                $review = mysqli_real_escape_string($con, $_POST['review']);

                                $sql = "INSERT INTO book_review(user_id, book_id, book_review) VALUES ('$user_id', '$book_id', '$review')";
                                if (mysqli_query($con, $sql)) {
                                    $successMessage = "Review submitted successfully!";
                                } else {
                                    $successMessage = "Error: " . mysqli_error($con);
                                }
                            } else {
                                $_SESSION['redirect_back'] = $_SERVER['REQUEST_URI'];
                                header("Location: login.php");
                                exit();
                            }
                        } ?>

                        <!-- Write a Review Button -->
                        <form method="post" action="">
                            <button type="submit" name="write_review" class="submit-btn"
                                style="margin-top:-5px;font-size:17px;cursor:pointer">
                                Write a review
                            </button>
                        </form>
                    </div>


                    <!-- Review Box (only if logged in and button clicked) -->
                    <?php if (!empty($showReviewBox)) { ?>
                        <div style="margin-top:30px;">
                            <form method="post">
                                <textarea name="review" rows="5" cols="50" placeholder="Write your review here..." required
                                    style="padding:10px;border-radius:6px"></textarea><br>
                                <button type="submit" name="submit_review" class="submit" style="margin-top:10px;">Submit
                                    Review</button>
                            </form>
                        </div>
                        <script>
                            window.onload = function () {
                                const reviewSection = document.getElementById("show");
                                if (reviewSection) {
                                    reviewSection.scrollIntoView({ behavior: "smooth" });
                                }
                            };
                        </script>
                    <?php } ?>

                    <!-- Success Message -->
                    <?php if (!empty($successMessage)) { ?>
                        <div style="margin-top:15px; color: green; font-weight: bold;font-size:18px">
                            <?php echo $successMessage; ?>
                        </div>
                        <script>
                            window.onload = function () {
                                const reviewSection = document.getElementById("show");
                                if (reviewSection) {
                                    reviewSection.scrollIntoView({ behavior: "smooth" });
                                }
                            };
                        </script>
                    <?php } ?>

                </div>


            </center>
        </div>

    </div>
</body>

</html>
<?php
include("footer_code.php"); ?>
<?php ob_end_flush(); ?>
<?php
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
    <link rel="stylesheet" href="review_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1 class="review-heading"><i>What Our Customer Says! </i></h1>
    <div class="ratings-review">
        <img src="r.jpeg" style="width:700px; height:400px" />
        <div class="website-review">
            <div class="overall-review">
                <b><p style="font-size: 50px;">4.3</p></b>
                <div class="no-of-stars">
                    <h2>Out of</h2>
                    <h2 style="margin-top:-20px;">5 stars</h2>
                </div>
                <div class="top-stars">
                    <span>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star"></i>
                        <i class="fa-solid fa-star-half-stroke"></i>
                    </span>
                </div>
            </div>
            <div class="rating-line">
                <h3 class="star-count">Overall rating of 347 reviews</h3>
            </div>
            <table>
                <tr>
                    <td class="star-count">5 Stars</td><td></td><td></td><td></td>
                    <td>
                        <div class="bar">
                            <div class="bar-fill1"></div>
                        </div>
                    </td><td></td><td></td><td>
                    <td class="star-count">230</td>
                </tr>
                <tr>
                    <td class="star-count">4 Stars</td><td></td><td></td><td></td>
                    <td>
                        <div class="bar">
                            <div class="bar-fill2"></div>
                        </div>
                    </td><td></td><td></td><td>
                    <td class="star-count">57</td>
                </tr>
                <tr>
                    <td class="star-count">3 Stars</td><td></td><td></td><td></td>
                    <td>
                        <div class="bar">
                            <div class="bar-fill3"></div>
                        </div>
                    </td><td></td><td></td><td>
                    <td class="star-count">30</td>
                </tr>
                <tr>
                    <td class="star-count">2 Stars</td><td></td><td></td><td></td>
                    <td>
                        <div class="bar">
                            <div class="bar-fill4"></div>
                        </div>
                    </td><td></td><td></td><td>
                    <td class="star-count">23</td>
                </tr>
                <tr>
                    <td class="star-count">1 Star</td><td></td><td></td><td></td>
                    <td>
                        <div class="bar">
                            <div class="bar-fill5"></div>
                        </div>
                    </td><td></td><td></td><td>
                    <td class="star-count">7</td>
                </tr>
            </table>
        </div>
    </div>
    <?php
    $query = "select website_review.* ,system_user.full_name from website_review
     join system_user  on  website_review.user_id=system_user.id order by website_review.review_id desc limit 6";
    $result = mysqli_query($con, $query);
    $review = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $review[] = $row;
    }
    ?>
    <div class="reviews">
        <div class="boxno1">
            <p class="review-size"><?php echo $review[0]['website_review'] ?></p>
            <div class="img-name">
                <img class="r-img" src="<?php echo $review[0]['profile_pic'] ?>" />
                <h3 class="r-name"><?php echo $review[0]['full_name'] ?></h3><br>
            </div>
        </div>
        <div class="boxno1">
            <p class="review-size"><?php echo $review[1]['website_review'] ?></p>
            <div class="img-name">
                <img class="r-img" src="<?php echo $review[1]['profile_pic'] ?>" />
                <h3 class="r-name"><?php echo $review[1]['full_name'] ?></h3><br>
            </div>
        </div>
        <div class="boxno1">
            <p class="review-size"><?php echo $review[2]['website_review'] ?></p>
            <div class="img-name">
                <img class="r-img" src="<?php echo $review[2]['profile_pic'] ?>" />
                <h3 class="r-name"><?php echo $review[2]['full_name'] ?></h3><br>
            </div>
        </div>
        <div class="boxno1">
            <p class="review-size"><?php echo $review[3]['website_review'] ?></p>
            <div class="img-name">
                <img class="r-img" src="<?php echo $review[3]['profile_pic'] ?>" />
                <h3 class="r-name"><?php echo $review[3]['full_name'] ?></h3><br>
            </div>
        </div>
        <div class="boxno1">
            <p class="review-size"><?php echo $review[4]['website_review'] ?></p>
            <div class="img-name">
                <img class="r-img" src="<?php echo $review[4]['profile_pic'] ?>" />
                <h3 class="r-name"><?php echo $review[4]['full_name'] ?></h3><br>
            </div>
        </div>
        <div class="boxno1">
            <p class="review-size"><?php echo $review[5]['website_review'] ?>
            </p>
            <div class="img-name">
                <img class="r-img" src="<?php echo $review[5]['profile_pic'] ?>" />
                <h3 class="r-name"><?php echo $review[5]['full_name'] ?></h3><br>
            </div>
        </div>
    </div>
    <hr>
    <div class="img-and-text">
        <img src="r2.jpeg" style="width:500px; height:300px" />
        <div class="block-size">
            <i><p style="font-size: 25px;">Based on valuable customer reviews, we continuously refine and enhance our
                    website to provide a
                    seamless and enjoyable reading experience for all !</p>
                <p style="font-size: 25px;">" Your feedback shapes our journey – we grow, refine, and innovate to create
                    the best experience for you...!!! " &#x1f3c6
                </p></i>
        </div>
    </div>
</body><br>
<a href="review_box.php" class="vertical-feedback">Feedback</a>
</body>
<?php
include("footer_code.php"); ?>
</html>

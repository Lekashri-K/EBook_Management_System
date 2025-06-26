<?php
session_start();
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}
include("configuration.php");
include("header_code.php");
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
    
    <link rel="stylesheet" href="footer_code.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-color:white;">

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


</body>

</html>
<?php
include("footer_code.php"); ?>
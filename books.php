<?php
session_start();
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}
include 'configuration.php';
include("header_code.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="footer_code.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="books.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body style="background-color:white;">
    <?php
    if (isset($_GET['category_id'])) {
        $category_id = $_GET['category_id'];
        // Fetch the category name
        $query = "SELECT category_name,category_des FROM categories WHERE category_id = $category_id";
        $result = mysqli_query($con, $query);
        if ($result) {
            $row = mysqli_fetch_assoc($result); ?>
            <div class="first-div">
                <center>
                    <h2 style="color:#0f172a;font-size:26px">Genre > <?php echo $row['category_name']; ?></h2><br>

                    <p style="font-size:18px;margin-top:-15px"> <?php echo $row['category_des'] ?></p>
                </center>
            </div>
            <?php
        } else {
            echo "Error in query: " . mysqli_error($con);
        }
        // Fetch books from the selected category
        $query_books = "SELECT * FROM books WHERE category_id = $category_id order by book_id desc";
        $result_books = mysqli_query($con, $query_books);

        $books = [];
        while ($book_row = mysqli_fetch_assoc($result_books)) {
            $books[] = $book_row;
        }
        ?>
        <div class="second-div">
            <!-- <h2>Adventure Books</h2> -->
            <center>
                <h2 style="color:#0f172a;font-size:26px"><?php echo $row['category_name']; ?> Books</h2><br>
            </center>
            <?php if (count($books) > 0) { ?>
                <?php for ($i = 0; $i < count($books); $i += 4) { ?>
                    <div class="row1">
                        <?php for ($j = $i; $j < $i + 4 && $j < count($books); $j++) { ?>
                            <div class="img-div">
                                <img src="<?php echo $books[$j]['book_img']; ?>" class="img-size">
                                <div class="text-div">
                                    <p style="font-size:18px"><?php echo $books[$j]['title']; ?></p>
                                    <p style="font-size:18px"><?php echo $books[$j]['author']; ?></p>
                                    <div class="buttons">
                                        <a href="book-details.php?book_id=<?php echo $books[$j]['book_id']; ?>" class="btn"
                                            style="text-decoration:none">View
                                            Details</a>
                                        <button class="price-btn">₹250</button>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            <?php } else { ?>
                <center style="margin-top:-20px">
                    No books found for this category.
                </center>
            <?php } ?>
        </div>
    <?php } ?>
    <div class="second-div">
        <?php
        $s_query = "select * from books order by book_id desc limit 5";
        $s_result = mysqli_query($con, $s_query);
        $s_books = [];
        while ($s_row = mysqli_fetch_array($s_result)) {
            $s_books[] = $s_row;
        }
        ?>
        <h2 style="color:#0f172a;font-size:24px">Recently Added Books</h2><br>
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
    </div>
</body>

</html>
<?php
include("footer_code.php"); ?>
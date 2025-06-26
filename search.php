<?php
session_start();
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}
include("configuration.php");
include("header_code.php");



?>
<center>
    <i>
        <h1>Search Results</h1>
    </i><br>
</center>
<?php
if (isset($_GET['search'])) {
    $search_term = mysqli_real_escape_string($con, $_GET['search']);
    $query = "SELECT * FROM books WHERE title LIKE '%$search_term%'";
    $result = mysqli_query($con, $query);
    $books = [];

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $books[] = $row;
        }

        for ($i = 0; $i < count($books); $i += 4) { ?>
            <div class="row1">
                <?php for ($j = $i; $j < $i + 4 && $j < count($books); $j++) { ?>
                    <div class="img-div">
                        <img src="<?php echo $books[$j]['book_img']; ?>" class="img-size">
                        <div class="text-div">
                            <p style="font-size:18px"><?php echo $books[$j]['title']; ?></p>
                            <p style="font-size:18px"><?php echo $books[$j]['author']; ?></p>
                            <div class="buttons">
                                <a href="book-details.php?book_id=<?php echo $books[$j]['book_id']; ?>" class="btn"
                                    style="text-decoration:none">View Details</a>
                                <button class="price-btn">₹250</button>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php }
        // } else {
        //     echo "<p>No results found for '<strong>$search_term</strong>'.</p>";
        // }
    } else { ?>
        <center>
            <img src="search.jpeg" style="height:400px;width:400px;margin-top:-25px">
            <p style="font-size:19px;">No results found for <?php echo "<strong> '$search_term'</strong>" ?></p>
        </center>
    <?php }
}
?>
<?php
include("footer_code.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link rel="stylesheet" href="books.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="header_style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="footer_code.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="sidebar-design.css?v=<?php echo time(); ?>">
</head>

<body>

</body>

</html>



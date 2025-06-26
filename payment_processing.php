<?php
session_start();
include("configuration.php");
$user_id = $_SESSION['id'];
$book_id = $_POST['book_id'];
$amount_paid = $_POST['price'];
$_SESSION['book_id']=$_POST['book_id'];
$_SESSION['book_file'] = $_POST['book_file'];
// echo $SESSION['book_file'];
$query = "INSERT INTO purchase (user_id, book_id, amount_paid) VALUES ($user_id, $book_id, $amount_paid)";
$result = mysqli_query($con, $query);
?>
<!DOCTYPE html>
<html>

<head>
    <title>Processing Payment...</title>
    <meta http-equiv="refresh" content="3;url=payment_success.php">
    <style>
        body {
            font-family: Arial;
            text-align: center;
            padding: 50px;
        }
    </style>
</head>
<?php
$query="update books set downloads=downloads+1 where book_id=$book_id";
$result = mysqli_query($con, $query);
?>
<body>
    
    <img src="loading2.gif" style="width:320px;height:320px;margin-top:50px">
    <div style="margin-top:-130px;">
        <h2>Processing Your Payment...</h2>
        <h3>Please wait while we process your order.</h3>
        <p>This process may take a few seconds,so please be patient.</p>
    </div>
    <!-- <form action="payment_success.php" method="post">
        <input type="hidden" name="book_id" value="<?php echo $book_id; ?>">
    </form> -->
    <!-- <?php echo "useriddddddddddddddddddddd" . $user_id; ?> -->
</body>

</html>
<?php
session_start();
include("configuration.php");
if (!isset($_SESSION["id"])) {
  $_SESSION['redirect_back'] = $_SERVER['REQUEST_URI'];
  header("Location:login.php");
  exit();
}
if (isset($_GET['id'])) {
  $book_id = $_GET['id'];
  $query = "select * from books where book_id=$book_id";
  $result = mysqli_query($con, $query);
  $book_details = mysqli_fetch_assoc($result);
}
?><!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dummy Payment Page</title>
  <link rel="stylesheet" href="payment.css?v=<?php echo time(); ?>">
</head>
<body>
  <div class="container">
    <h2>Payment</h2>
    <div class="book-details">
      <p><strong>Book Name:</strong><?php echo $book_details['title'] ?></p>
      <p><strong>Price:</strong> ₹<?php echo $book_details['price'] ?></p>
    </div>
    <form action="payment_processing.php" method="post" autocomplete="off">
      <div class="input-group">
        <label for="card-name">Name on Card</label>
        <input type="text" id="card-name" name="card_name" required>
      </div>
      <div class="input-group">
        <label for="card-number">Card Number</label>
        <input type="text" id="card-number" name="card_number" maxlength="16" required>
      </div>
      <div class="payment-methods">
        <label><input type="radio" name="method" value="MasterCard" checked> CreditCard</label>
        <label><input type="radio" name="method" value="Visa"> Net Banking</label>
        <label><input type="radio" name="method" value="UPI"> UPI</label>
      </div>
      <input type="hidden" name="book_id" value="<?php echo $book_details['book_id']; ?>">
      <input type="hidden" name="book_file" value="<?php echo $book_details['book_file']; ?>">
      <input type="hidden" name="price" value="<?php echo $book_details['price']; ?>">
      <button type="submit" class="btn">Pay Now</button>

    </form>
  </div>
</body>
</html>
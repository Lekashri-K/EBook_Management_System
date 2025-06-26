<!-- 
<?php
session_start();

if (isset($_SESSION["book_file"])) {
    $book_file = $_SESSION['book_file'];

}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Payment Successful</title>
    <style>
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4caf50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 15px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #388e3c;
        }
    </style>
</head>

<body>
    <div style="text-align: center; margin-top: 175px;">
        <img src="success.gif" style="width:150px;height:150px">
        <div style="margin-top:-30px">
            <h2>Payment Successful!</h2>
            <p>Thank you for purchasing. Your eBook is now available.</p>
            <a href="download.php" class="btn">Download Now</a><br><br>
            <a href="index.php" >Go to Homepage</a>
        </div>
    </div>
</body>

</html> -->



<?php
include('configuration.php');
// Include PHPMailer class
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'C:\xampp\htdocs\EBMS\phpmailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\EBMS\phpmailer\src\SMTP.php';
require 'C:\xampp\htdocs\EBMS\phpmailer\src\Exception.php';// Path to your PHPMailer

$mail = new PHPMailer(true); // Passing true enables exceptions

try {
    //Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';  // Set the SMTP server to send through
    $mail->SMTPAuth = true;          // Enable SMTP authentication
    $mail->Username = 'ebooks6075@gmail.com';     // Your Gmail address
    $mail->Password = 'dxyq rmms imbl prkm';   // Your Gmail password or app-specific password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;  // TCP port to connect to
    $book_stmt = mysqli_prepare($con, "SELECT title, author, price, book_file FROM books WHERE book_id = ?");
    $book_stmt = mysqli_prepare($con, "SELECT title, author, price, book_file FROM books WHERE book_id = ?");
    mysqli_stmt_bind_param($book_stmt, "i", $_SESSION['book_id']);
    mysqli_stmt_execute($book_stmt);
    $book_result = mysqli_stmt_get_result($book_stmt);

    if (mysqli_num_rows($book_result) == 0) {
        echo "⚠️ Book not found. Please try again.";
        exit();
    }
    $book = mysqli_fetch_assoc($book_result);

    // Fetch user details
    $user_stmt = mysqli_prepare($con, "SELECT name, email FROM system_user WHERE id = ?");
    mysqli_stmt_bind_param($user_stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($user_stmt);
    $user_result = mysqli_stmt_get_result($user_stmt);

    if (mysqli_num_rows($user_result) == 0) {
        echo "⚠️ User not found. Please try again.";
        exit();
    }
    $user = mysqli_fetch_assoc($user_result);

    // Fetch order details (purchase date and download link)
    $order_stmt = mysqli_prepare($con, "SELECT purchase.purchase_date,
     books.book_file FROM purchase join books on purchase.book_id=books.book_id WHERE purchase.user_id = ? AND purchase.book_id = ?");
    mysqli_stmt_bind_param($order_stmt, "ii", $_SESSION['id'], $_SESSION['book_id']);
    mysqli_stmt_execute($order_stmt);
    $order_result = mysqli_stmt_get_result($order_stmt);

    if (mysqli_num_rows($order_result) == 0) {
        echo "⚠️ Order not found. Please try again.";
        exit();
    }
    $order = mysqli_fetch_assoc($order_result);
    $purchase_date = date("F j, Y", strtotime($order['purchase_date']));  // Format the date
    $download_link = "http://localhost/EBMS/download.php?file=" . urlencode($order['book_file']);
    //Recipients
    $mail->setFrom('ebooks6075@gmail.com', 'Ebook Galaxy'); // Your email and name
    $mail->addAddress($user['email'], $user['name']); // Recipient's email

    //Content
    $mail->isHTML(true);
    $mail->Subject = ' Purchase Confirmation - Ebook Galaxy';
    $mail->Body = "
    <html>
    <head>
        <title>Purchase Confirmation</title>

    </head>
    <body style='font-family: Arial, sans-serif; color: #333;'>
        <h2 style='color: #2c3e50;'>Hello {$user['name']},</h2>
        <p>🎉 Thank you for your purchase on <strong>Ebook Galaxy</strong>!</p>
        <p>Here are your order details:</p>
        <ul>
            <li><strong>Book Name:</strong> {$book['title']}</li>
            <li><strong>Author:</strong> {$book['author']}</li>
            <li><strong>Price:</strong> ₹{$book['price']}</li>
            <li><strong>Purchase Date:</strong> $purchase_date</li>
        </ul>
        <p><strong>📥 Download Link:</strong> <a href='$download_link' style='color: #2980b9;'>Click here to download your book</a></p>
        <br>
        <p>Happy Reading! 📚</p>
        <p>Regards,<br><strong>Ebook Galaxy Team</strong></p>
    </body>
    </html>
    ";

    // Send the email
    if ($mail->send()) {
        echo "<div style='text-align: center; margin-top: 175px;'>
            <img src='success.gif' style='width:150px;height:150px'>
            <div style='margin-top:-30px'>
                <h2>Payment Successful!</h2>
                <p>Thank you for purchasing. Your eBook is now available.</p>
                <form method='get' action='$download_link'>
                    <button type='submit' class='btn'>Download Book</button>
                </form>
                 <a href='index.php' class='anchor'>Go to Homepage</a>
            </div>
        </div>";
    } else {
        echo "<div style='text-align: center; margin-top: 175px;'>
        <img src='error.gif' style='width:150px;height:150px'>
        <div style='margin-top:-30px'>
            <h2>⚠️ Email sending failed, but your payment is confirmed.</h2>
            <p>Your eBook is now available for download.</p>
            <form method='get' action='$download_link'>
                <button type='submit' class='btn' style='padding: 10px 20px; background-color: #e74c3c; color: white; border: none; border-radius: 5px;'>Download Book</button>
            </form><br><br>
             <a href='index.php'>Go to Homepage</a>
        </div>
    </div>
";
    }
} catch (Exception $e) {
    echo "⚠️ Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #4caf50;
    border-color:  #4caf50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin-top: 15px;
    font-weight: bold;
}
.btn:hover {
    background-color: #388e3c;
}
</style>
</head>
<body>
    
</body>
</html>
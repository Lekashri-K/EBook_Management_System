<?php
session_start();
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}
include 'configuration.php';
include("header_code.php");
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!isset($_SESSION['name'])) {
        $_SESSION['redirect_back'] = $_SERVER['REQUEST_URI'];
        header('Location: login.php');
        exit();
    }
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $mobileno = mysqli_real_escape_string($con, $_POST['mobileno']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $message = mysqli_real_escape_string($con, $_POST['message']);
    if (!preg_match("/^[a-zA-Z\s]{4,}$/", $name)) {
        $error_msg = "⚠️Name must contain only letters and spaces (minimum 4 characters).";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_msg = "⚠️Invalid email format.";
    }
    if (strlen($_POST['mobileno']) !== 10) {
        $error_msg = "⚠️ Contact mumber should be exactly 10 digits";
    } else {
        $sql = "INSERT INTO contact_request (name, mobileno, email, message) 
            VALUES ('$name', '$mobileno', '$email', '$message')";
        if (mysqli_query($con, $sql)) {
            $success_msg = "Your message has been sent successfully!";
        } else {
            $error_msg = "Oops! Something went wrong. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="contact.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="footer_code.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>

    <body style="background-color: white;">
        <div class="images">
            <img class="con-image" src="contact-image2.jpeg" />
            <img class="con-image" src="contact-image1.jpeg" />
        </div>
        <div>
            <h2 class="contact-box" style="text-align:center;"> Get In Touch With Us Now!</h2>
            <i>
                <p class="contact-box-para">we're here to assist, listen, and make things happen for you!</p>
            </i>
            <hr>
            <div class="row">
                <div><br>
                    <big class="icon1"><i class="fa-solid fa-phone"></i><br></big>
                    <b class="phone-no">Phone Number</b>
                    <p class="phone-no1"> +91 80004 36640</p>
                </div>
                <div><br>
                    <big class="icon2"><i class="fa-solid fa-envelope"></i><br></big>
                    <b class="Email">Email</b>
                    <p class="Email1"> ebookgalaxy@gmail.com</p>
                </div>
                <div><br>
                    <big class="icon3"><i class="fa-solid fa-location-dot"></i><br></big>
                    <b class="location">Location</b>
                    <p class="location1">Sengipatty,Thanjavur</p>
                </div>
                <div><br>
                    <big class="icon4"><i class="fa-solid fa-clock"></i><br></big>
                    <b class="wh">Working Hours</b>
                    <p class="wh1"> 24/7 hours</p>
                </div>
            </div>
            <hr>
        </div>
        <div class="contact-divno2">
            <div class="contact-img">
                <img style="margin-left:20px;" src="contact-image.jpeg" />
            </div>
            <div class="form">
                <div class="head">
                    <h2 class="contact-heading" id="success">Contact Us</h2>
                </div>
                <?php if (isset($success_msg)): ?>
                    <div class="alert success"><?= $success_msg ?></div>
                <?php elseif (isset($error_msg)): ?>
                    <div class="alert error"><?= $error_msg ?></div>
                <?php endif; ?>
                <div class="box">
                    <form method="POST" action="contact.php#success" autocomplete="off">
                        <table class="box1">
                            <tr>
                                <td>
                                    <div class="input-container">
                                        <i class="fas fa-user fa-sm"></i>
                                        <input class="form-div" type="text" name="name" placeholder="Enter your name"
                                            required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-container">
                                        <i class="fa-solid fa-phone fa-sm"></i>
                                        <input class="form-div" type="number" name="mobileno"
                                            placeholder="Enter your mobile number" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="input-container">
                                        <i class="fa-solid fa-envelope fa-sm"></i>
                                        <input class="form-div" type="email" name="email"
                                            placeholder="Enter your mail id" required>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input class="msg" type="text" name="message" placeholder=" Message"
                                        style="border-radius:15px" required>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button class="submit" type="submit">Submit</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>
<?php
include("footer_code.php"); ?>
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
   
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <link rel="stylesheet" href="about.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    

</head>

<body style="background-color:white;">
    <div class="aboutus">
        <br>
        <h1><i>Discover Our Journey & Vision !</i></h1>

    </div>
    <div class="divno1">
        <div class="para">
            <h1><i>Empowering Your Reading Experience With Us!</i></h1>
            <h3> We are a passionate team dedicated to transforming the reading experience through digital innovation.
                Our E-Book Management System is built to provide seamless access to a diverse collection of books,
                making reading more convenient, accessible, and enjoyable for everyone.

                With a commitment to quality, security, and user satisfaction, we strive to create a platform where book
                lovers can explore, purchase, and enjoy their favorite titles with ease. Whether you love adventure,
                horror, mystery & thriller, science-fiction or historical, our platform is designed to cater to your
                reading needs.

            </h3>
            <h3>In a world where stories fuel imagination and knowledge sparks growth, we are here to bridge the gap
                between readers and the books they love. Join us on this journey and discover a smarter way to read!Step
                into a world where books are always within reach - anytime, anywhere.</h3>
        </div>
        <div>
            <img src="about-img1.jpeg" class="imgg" />
        </div>
    </div>
    <!-- <hr> -->
    <div class="divno2">
        <div class="divno2-flex">
            <div>
                <p class="psize">55K+</p>
                <p class="font-size">Happy Client</p>
            </div>
            <div class="emoji-adjust">
                <i class="fa-regular fa-face-smile-wink fa-3x"></i>
            </div>
        </div>
        <div class="divno2-flex">
            <div>
                <p class="psize">7K+</p>
                <p class="font-size">Active Users</p>
            </div>
            <div class="emoji-adjust">
                <i class="fa-solid fa-users-viewfinder fa-3x" style="margin-top: 10px;"></i>
            </div>
        </div>
        <div class="divno2-flex">
            <div>
                <p class="psize">1K+</p>
                <p class="font-size">Partner</p>
            </div>
            <div class="emoji-adjust">
                <i class="fa-regular fa-handshake fa-3x" style="margin-top: 8px;margin-left:10px"></i>
            </div>
        </div>
        <div class="divno2-flex">
            <div>
                <p class="psize">4+</p>
                <p class="font-size">Country</p>
            </div>
            <div class="emoji-adjust">
                <i class="fa-regular fa-flag fa-3x" style="margin-top:10px"></i>
            </div>

        </div>
    </div>
    <br>
    <!-- <hr> -->
    <br>
    <b><i>
            <div class="choose" style="font-size:30px;">Why Choose Us ?</div>
        </i></b>
    <br><br>

    <div class="divno3">
        <div class="about-icon">
            <i class="fa-solid fa-lock fa-4x"></i>
            <b>
                <p style="font-size:xx-large;">Security</p>
            </b>
            <p class="about-text">We proritize the safety of our customer's data & privacy and prevents the unauthorized
                access.</p>
        </div>
        <div class="about-icon">

            <!-- <i class="fa-solid fa-users fa-3x"></i> -->
            <i class="fa-solid fa-users-gear fa-3x"></i>
            <b>
                <p style="font-size:xx-large;">Scalability</p>

            </b>
            <p class="about-text">The system is designed to handle growing users and data efficiently without
                performance issues.</p>
        </div>
        <div class="about-icon">
            <i class="fa-solid fa-circle-check fa-3x"></i>
            <b>
                <p style="font-size:xx-large;">24/7 Accessability</p>
            </b>
            <p class="about-text">The platform remains operational 24/7, ensuring uninterrupted access to digital
                content.</p>

        </div>
    </div>
    <br><br><br>

    <div class="divno4">
        <div class="about-image">
            <!-- <img src="C:\Users\Lekashri\Downloads\WhatsApp Image 2025-03-06 at 9.43.33 PM.jpeg" class="imgg2">
            <img src="C:\Users\Lekashri\Downloads\WhatsApp Image 2025-03-06 at 9.43.40 PM.jpeg" class="imgg2"> -->
            <img src="about-img2.jpeg" class="imgg2">
            <!-- <img src="C:\Users\Lekashri\Downloads\WhatsApp Image 2025-03-06 at 9.43.39 PM.jpeg" class="imgg2"> -->
        </div>
        <div class="divno4-text">
            <h1>Use only with 4 easy steps</h1><br><br>
            <div class="about-steps">
                <div class="number">
                    <i class="bi bi-1-circle"></i>
                </div>
                <div class="letter">
                    <h2>Sign Up and Create an Account</h2>
                    <p class="ssize">Create your account by providing basic details.Once registered, explore a wide
                        range of books
                        across various genres. Discover trending, bestselling books.</p>
                </div>

            </div>
            <br>
            <div class="about-steps">
                <div class="number">
                    <i class="bi bi-2-circle"></i>
                </div>
                <div class="letter">
                    <h2>Choose Your Book</h2>
                    <p class="ssize">Browse through our extensive collection and find books that match your interests.
                        Use filters
                        like title name, category, and ratings for easy selection.</p>
                </div>
            </div>
            <br>
            <div class="about-steps">
                <div class="number">
                    <i class="bi bi-3-circle"></i>
                </div>
                <div class="letter">
                    <h2>Purchase & Read</h2>
                    <p class="ssize">Purchase the desired book .Once purchased the book is instantly added to your
                        library.Enjoy a
                        smooth
                        reading experience.</p>
                </div>
            </div>
            <br>
            <div class="about-steps">
                <div class="number">
                    <i class="bi bi-4-circle"></i>
                </div>
                <div class="letter">
                    <h2>Enjoy Anytime</h2>
                    <p class="ssize">With 24/7 accessability users can read their eBooks anytime,anywhere,without
                        restrictions.The
                        platform provide uninterrupted access.</p>
                </div>
            </div>

        </div>

    </div>

</html>
<?php
include("footer_code.php"); ?>
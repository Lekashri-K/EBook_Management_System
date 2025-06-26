<?php
session_start();
if (isset($_SESSION["id"])) {
    $user_id = $_SESSION['id'];
}
include("configuration.php");
include("header_code.php");
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="help.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <center>
        <big>
            <p><i class="fa fa-comments"></i></p>
        </big>
        <h2>Got Questions <i class="fa-solid fa-question"></i> </h2>
        <h2>We've Got Answers</h2>
    </center>
    <div class="picture">
        <big>
            <p>Below you'll find answers to the most common questions you may have on E-Book Galaxy.If you still
                can't
                find the answer you're looking for,just <a href="contact.php">Contact us!</a></p>
        </big>
        <center>
            <img src="help-image.jpeg" alt="no image">
        </center>
    </div>
    <h2 style="text-align: center;">Recently Asked Questions :)</h2>
    <div class="askquestion">
        <details class="faq-size">
            <summary>Do I need to register before purchasing an ebook?</summary>
            <p>Yes, you need to register to create an account.Once registered and logged in, you can
                purchase any ebook from our online bookstore. If you already registered, you can just login to
                purchase.</p>
        </details>
        <details class="faq-size">
            <summary>Can I view the content of the ebook before purchase?</summary>
            <p>No, the content of eBooks can only be viewed after purchase.Ebook Galaxy allows full access to a
                book’s content only after it has been purchased.</p>
        </details>
        <details class="faq-size">
            <summary>Is there a refund policy for purchased eBooks?</summary>
            <p>Due to the digital nature of eBooks, all sales are final and non-refundable. We recommend reviewing
                book descriptions and details carefully before purchasing.</p>
        </details>
        <details class="faq-size">
            <summary>Can I request a book that is not available on the website?</summary>
            <p>Yes! If you can’t find a specific book, you can request the book via contact form. Our team will try
                to make it available as soon as possible.</p>
        </details>
        <details class="faq-size">
            <summary>What payment methods are accepted on Ebook Galaxy?</summary>
            <p>We accept multiple payment methods including credit/debit cards, UPI, and net banking for secure and
                easy transactions.</p>
        </details>
        <details class="faq-size">
            <summary>Can I access the eBooks I purchased anytime?</summary>
            <p>Yes, once you purchase an eBook, it will be available in your account under "Order Details" for
                unlimited access at any time.</p>
        </details>
        <details class="faq-size">
            <summary>How can I change my account information or password?</summary>
            <p>You can update your account details or change your password anytime by logging in and visiting the
                "Edit Profile" or "Change Password" section in your user dashboard.
            </p>
        </details>
        <details class="faq-size">
            <summary>What should I do if I encounter an issue or need support?</summary>
            <p>If you face any issues or need help, you can reach out to our support team through the "Contact Us"
                page.Just fill out the form with your issue or question, and we’ll get back to you within 24 hours.
            </p>
        </details>
    </div>
</body>
</html>
<?php
include("footer_code.php"); ?>
<?php
session_start();

// Simulate a logged-in user (for testing only)
$_SESSION['id'] = 1;

$showReviewBox = false;
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['write_review'])) {
        $showReviewBox = true;
    }

    if (isset($_POST['submit_review'])) {
        if (!empty($_POST['rating']) && !empty($_POST['review'])) {
            $rating = $_POST['rating'];
            $review = $_POST['review'];

            // Simulate storing in DB (just for demo)
            $successMessage = "Success! You rated $rating stars and said: $review";
        } else {
            $successMessage = "Please fill both fields!";
            $showReviewBox = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Test Review</title>
    <style>
        .rate-stars input {
            display: none;
        }

        .rate-stars label {
            font-size: 24px;
            color: #ccc;
            cursor: pointer;
        }

        .rate-stars input:checked ~ label,
        .rate-stars label:hover,
        .rate-stars label:hover ~ label {
            color: gold;
        }

        .submit-btn {
            background-color: #0f172a;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 6px;
        }
    </style>
</head>
<body>

<form method="post">
    <button type="submit" name="write_review" class="submit-btn">Write a Review</button>
</form>

<?php if (!empty($showReviewBox)) { ?>
    <form method="post">
        <div class="rate-stars" style="margin-bottom:10px;">
            <?php for ($i = 5; $i >= 1; $i--) { ?>
                <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" required />
                <label for="star<?= $i ?>" class="fa fa-star">&#9733;</label>
            <?php } ?>
        </div>
        <textarea name="review" rows="4" cols="50" placeholder="Write your review..." required></textarea><br>
        <button type="submit" name="submit_review" class="submit-btn">Submit</button>
    </form>
<?php } ?>

<?php if (!empty($successMessage)) { ?>
    <div style="margin-top:10px;color:green;">
        <?= $successMessage ?>
    </div>
<?php } ?>

</body>
</html>





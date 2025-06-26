<?php
session_start();
include("configuration.php");
if (!isset($_SESSION["id"])) {
  $_SESSION['redirect_back']=$_SERVER['REQUEST_URI'];
  header("Location:login.php");
 
}
if (isset($_POST["submit"])) {
  $successMessage = "";
  $id = $_SESSION['id'];
  $website_review = mysqli_real_escape_string($con,$_POST['review']);
  if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {
    $photo = $_FILES['photo']['name'];
    $tmp_name = $_FILES['photo']['tmp_name'];

    $upload_path = "images/" . basename($photo);

   
    if (move_uploaded_file($tmp_name, $upload_path)) {
     
      $query = "insert into website_review (user_id,website_review,profile_pic)
      values($id,'$website_review','$photo')";
      $result = mysqli_query($con, $query);

      if ($result) {
        $successMessage = "Your review has been sent successfully!";
      }
    }
  } else {
    $photo = 'profile.jpeg';
    $query = "insert into website_review (user_id,website_review,profile_pic)
      values($id,'$website_review','$photo')";
    $result = mysqli_query($con, $query);
    if ($result) {
      $successMessage = "Your review has been sent successfully!";
    }
  }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Review Form</title>
  <link rel="stylesheet" href="review_box.css?v=<?php echo time(); ?>">
</head>

<body>

  <form class="review-container" action="" method="post" enctype="multipart/form-data">
    <h2>Write a Review</h2>
    <center>
      <?php
      if (isset($successMessage)) {
        echo "<p style='text-align:center; color:green; 
        font-weight:bold;background-color:#d4edda;padding:10px '>$successMessage</p>";
      }
      ?>
    </center>
    <label for="review">Your Review <span style="color:red;">*</span></label>
    <textarea id="review" name="review" placeholder="Send your review,you can also say how many stars you'd give..." required></textarea>

    <label for="photo">Upload Photo (optional)</label>
    <input type="file" name="photo" class="photo" accept="image/*">
    <center>
      <button type="submit" name="submit" style="margin-bottom:10px">Submit Review</button>
      <a href="review.php" style="text-decoration:none">Go Back</a>

    </center>

  </form>

</body>

</html>
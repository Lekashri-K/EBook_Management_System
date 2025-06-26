<?php
session_start();
include("configuration.php");
include("admin_sidebar2.php");
$success_msg = "";
$error_msg = "";

if (isset($_POST['submit'])) {
    $category_name = $_POST['category_name'];
    $category_des=mysqli_real_escape_string($con,$_POST['category_des']);
    // Check if same category name already exists or not
    $check_query = "SELECT * FROM categories WHERE category_name = '$category_name'";
    $check_result = mysqli_query($con, $check_query);
    if (mysqli_num_rows($check_result) > 0) {
        $error_msg = "Category name already exists. Please choose a different name !";
    } else {
        if (isset($_FILES['category_img']) && $_FILES['category_img']['error'] == 0) {
            $category_img_name = $_FILES['category_img']['name'];
            $tmp_name = $_FILES['category_img']['tmp_name'];
            $upload_path = "images/" . basename($category_img_name);
            if (move_uploaded_file($tmp_name, $upload_path)) {
                $query = "INSERT INTO categories (category_name, category_img,category_des) VALUES ('$category_name', '$category_img_name','$category_des')";
                $result = mysqli_query($con, $query);

                if ($result) {
                    $success_msg = "Category added successfully!";
                } else {
                    $error_msg = "Failed to insert into database.";
                }
            } else {
                $error_msg = "Failed to upload image.";
            }
        } else {
            $error_msg = "Please select a valid image file.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="add_category.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .main-content {
            margin-left: 0;
            margin-left: -20px;
            width: 100%;
            /* overflow-wrap: break-word; */
        }
    </style>
</head>

<body>
    <div class="main-content1">
        <center>
            <div class="form-container">
                <h2 class="form-title">Add Category</h2>
                <?php
                if (!empty($success_msg)) { ?>
                    <center>
                        <p style="color:green"><?php echo $success_msg; ?></p>
                    </center>

                <?php } else { ?>
                    <center>
                        <p style="color:red"><?php echo $error_msg; ?></p>
                    </center>

                <?php } ?>
                <form action="add-category.php" method="post" enctype="multipart/form-data" autocomplete="off">
                    <div class="form-group">
                        <label>Category Name <span style="color: red;">*</span></label><br>
                        <input type="text" name="category_name" required>
                    </div>
                    <div class="form-group">
                        <label>Category Description<span style="color: red;">*</span></label><br>
                        <input type="textarea" name="category_des" required>
                    </div>
                    <div class="form-group">
                        <label>Category Image <span style="color: red;">*</span></label><br>
                        <input type="file" name="category_img" accept="image/*" required>
                    </div>
                   

                    <button type="submit" class="submit-btn" name="submit">Submit</button>
                </form>
            </div>
        </center>
    </div>


</body>

</html>
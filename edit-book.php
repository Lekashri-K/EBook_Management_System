<?php
session_start();
include("configuration.php");
include("admin_sidebar2.php");
$success_msg = "";
$error_msg = "";
if (isset($_GET['id'])) {
    $book_id = $_GET['id'] ?? '';
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $title = $_POST['title'] ?? '';
    $author = $_POST['author'] ?? '';
    $category_name = $_POST['category_name'] ?? '';

    $category_query = "SELECT category_id FROM categories WHERE category_name = '$category_name' LIMIT 1";
    $category_result = mysqli_query($con, $category_query);

    if ($category_result && mysqli_num_rows($category_result) > 0) {
        $row = mysqli_fetch_assoc($category_result);
        $category_id = $row['category_id'];

        $price = $_POST['price'] ?? '';
        $book_des = $_POST['book_des'] ?? '';
        $author_des = $_POST['author_des'] ?? '';
        $isbn = $_POST['isbn'] ?? '';
        $publisher = $_POST['publisher'] ?? '';
        $published_date = $_POST['published_date'] ?? '';
        $pages = $_POST['pages'] ?? '';
        $total_books = $_POST['total_books'] ?? '';

        $book_img = $_FILES['book_img']['name'];
        $book_file = $_FILES['book_file']['name'];
        $author_img = $_FILES['author_img']['name'];

        if (!empty($book_img) && !empty($book_file)) {
            move_uploaded_file($_FILES['book_img']['tmp_name'], "images/" . $book_img);
            move_uploaded_file($_FILES['author_img']['tmp_name'], "images/" . $author_img);
            move_uploaded_file($_FILES['book_file']['tmp_name'], "books/" . $book_file);
            // echo $title;
            $update_query = "UPDATE books SET 
            title = '$title',
            author = '$author',
            category_id = '$category_id',
            price = '$price',
            book_des = '$book_des',
            author_des = '$author_des',
            isbn = '$isbn',
            publisher = '$publisher',
            published_date = '$published_date',
            pages = '$pages',
            total_books = '$total_books',
            book_img = '$book_img',
            author_img = '$author_img',
            book_file = '$book_file'
            WHERE book_id = '$book_id'";
            // echo $update_query;

            if (mysqli_query($con, $update_query)) {
                $success_msg = "Book updated successfully!";
            } else {
                $error_msg = "Insert failed: " . mysqli_error($con);
            }
        } else {
            $error_msg = "Please upload book image and book PDF.";
        }
    } else {
        $error_msg = "Category not found!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="add_book.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="admin_style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- <style>
        .main-content {
            margin-left: 0;
            margin-left: -20px;
            width: 100%;
        }
    </style> -->
</head>

<body>
    <div class="main-content1">
        <div class="header">
            <div class="form-container">
                <h2>Edit Book</h2>
                <?php if (!empty($success_msg))
                    echo "<p class='success-msg' style='font-size:18px'>$success_msg</p>"; ?>
                <?php if (!empty($error_msg))
                    echo "<p class='error-msg' style='font-size:18px'>$error_msg</p>"; ?>

                <form action="" method="POST" enctype="multipart/form-data">
                    <label>Title <span class="required">*</span></label>
                    <input type="text" name="title"><br>

                    <label>Author <span class="required">*</span></label>
                    <input type="text" name="author"><br>

                    <label>Category Name <span class="required">*</span></label>
                    <input type="text" name="category_name"><br>

                    <label>Price <span class="required">*</span></label>
                    <input type="number" name="price"><br>

                    <label>Book Description<span class="required">*</span></label>
                    <textarea name="book_des" required></textarea><br>

                    <label>Author Description<span class="required">*</span></label>
                    <textarea name="author_des" required></textarea><br>

                    <label>ISBN<span class="required">*</span></label>
                    <input type="text" name="isbn" required><br>

                    <label>Publisher<span class="required">*</span></label>
                    <input type="text" name="publisher" required><br>

                    <label>Published Date<span class="required">*</span></label>
                    <input type="date" name="published_date" required><br>

                    <label>Pages<span class="required">*</span></label>
                    <input type="number" name="pages" required><br>

                    <label>Total Books</label>
                    <input type="number" name="total_books"><br>

                    <label>Book Image <span class="required">*</span></label>
                    <input type="file" name="book_img" required><br>

                    <label>Author Image <span class="required">*</span></label>
                    <input type="file" name="author_img" required><br>

                    <label>Book File (PDF) <span class="required">*</span></label>
                    <input type="file" name="book_file" accept=".pdf" required><br>
                    <center>
                        <button type="submit" class="submit-btn">Save Changes</button>
                    </center>

                </form>
            </div>
        </div>
</body>

</html>
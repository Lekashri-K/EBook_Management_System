<?php
include('configuration.php');
if (isset($_GET['id1'])) {
    $cate_id = $_GET['id1'];
    $query = "DELETE FROM categories WHERE category_id = '$cate_id'";
    mysqli_query($con, $query);

} elseif (isset($_POST['cate_id'])) {
    $cate_id = $_POST['cate_id'];
    $query = "DELETE FROM categories WHERE category_id = '$cate_id'";
    mysqli_query($con, $query);

}

   
header("Location: view_books.php?deleted=1#msg"); // Go back to original page
exit();
?>
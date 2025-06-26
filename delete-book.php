<?php
include('configuration.php');
if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $query = "DELETE FROM books WHERE book_id = '$book_id'";
    mysqli_query($con, $query);
  
}
header("Location: view_books.php?deleted=2#msgg");// Go back to original page
exit();
?>

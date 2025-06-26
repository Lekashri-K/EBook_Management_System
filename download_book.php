<?php
session_start();
include("configuration.php");

if (isset($_GET['purchase_id'])) {
    $purchase_id = $_GET['purchase_id']; 
    $query = "SELECT books.book_file FROM purchase 
              JOIN books ON purchase.book_id = books.book_id 
              WHERE purchase.purchase_id = $purchase_id";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);
        $file = basename($row['book_file']);
        $filepath = 'books/' . $file;

        if (file_exists($filepath)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . $file . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($filepath));
            readfile($filepath);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Invalid purchase ID.";
    }
} else {
    echo "No purchase ID provided.";
}
?>
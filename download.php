
<?php
session_start();

if (isset($_SESSION['book_file'])) {
    $file = basename($_SESSION['book_file']); 
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
} else { ?>
    <center style="margin-top:50px">
    <?php echo "No file found for download.";?>
</center>
<?php } ?>
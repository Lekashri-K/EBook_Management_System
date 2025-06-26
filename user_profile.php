<?php
session_start();

// print_r($_SESSION);
// echo "fullname". $_SESSION['full_name'];
if (isset($_SESSION['full_name'])) {
    ?>
    <center>
        <h2><?php echo "Welcome " . htmlspecialchars($_SESSION['full_name']); ?></h2>
    </center>
<?php } else {
    echo "Guest User";
}
?>
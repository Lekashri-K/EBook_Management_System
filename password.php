
<?php
session_start();
include("configuration.php");
// echo "Session ID: " . $_SESSION['id'];
// Enable error reporting
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

$message = "";
$old_password_error = "";
$new_password_error = "";
$confirm_password_error = "";
if(isset($_SESSION["redirect_after_login"])){
    $redirect=$_SESSION["redirect_after_login"];
}
else{
    $redirect='index.php';
}

if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $user_id = $_SESSION['id'];
    $old_password = trim($_POST['old_password']);
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

  
    $query = "SELECT password FROM system_user WHERE id = '$user_id'";
    $result = mysqli_query($con, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $stored_password = $row['password'];
        if ($old_password!== $stored_password) {
            $old_password_error = "⚠️ Old password is incorrect.";
        }

        if (strlen($new_password) < 8) {
            $new_password_error = "⚠️ At least 8 characters required.";
        } elseif (!preg_match("#[0-9]+#", $new_password)) {
            $new_password_error = "⚠️ Must include at least one digit.";
        } elseif (!preg_match("#[a-z]+#", $new_password)) {
            $new_password_error = "⚠️ Must include at least one lowercase letter.";
        } elseif (!preg_match("#[A-Z]+#", $new_password)) {
            $new_password_error = "⚠️ Must include at least one uppercase letter.";
        } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $new_password)) {
            $new_password_error = "⚠️ Must include at least one special character.";
        }

        if ($new_password !== $confirm_password) {
            $confirm_password_error = "⚠️ Passwords do not match.";
        }
        if (empty($old_password_error) && empty($new_password_error) && empty($confirm_password_error)) {
            // $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update = "UPDATE system_user SET password = '$new_password' WHERE id = '$user_id'";
            if (mysqli_query($con, $update)) {
                $message = '<div style="color: green; font-weight: bold;font-size:18px;margin-top:50px">Password updated successfully!</div>';
            } else {
                $message = '<div style="color: red; font-weight: bold;">Failed to update password.</div>';
            }
        }
    } else {
        $message = '<div style="color: red; font-weight: bold;">User not found.</div>';
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="password_page.css?v=<?php echo time(); ?>">
</head>

<body>
    <center>
       
        <?php echo $message; ?>
        <div class="box-shadow">
            <h2>Change Password</h2>
            <form method="POST" action="">
                <table>
                    <tr>
                        <td>Current Password<span style="color: red;">*</span></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="old_password" required>
                            <div style="color: red;"><?php echo $old_password_error; ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>New Password<span style="color: red;">*</span></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="new_password" required>
                            <div style="color: red;"><?php echo $new_password_error; ?></div>
                        </td>
                    </tr>

                    <tr>
                        <td>Confirm New Password<span style="color: red;">*</span></td>
                    </tr>
                    <tr>
                        <td><input type="password" name="confirm_password" required>
                            <div style="color: red;"><?php echo $confirm_password_error; ?></div>
                        </td>
                    </tr>
                </table>
                <button type="submit" name="submit" class="submit-btn">Sumbit</button><br><br>
                <a href="<?php echo $redirect?>" style="text-decoration:none">Leave Page</a>
            </form>
        </div>
    </center>
</body>

</html>
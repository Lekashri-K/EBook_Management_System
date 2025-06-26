<?php
session_start();
include("configuration.php");


if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

if(isset($_SESSION["redirect_after_login"])){
    $redirect=$_SESSION["redirect_after_login"];
}
else{
    $redirect='index.php';
}
$user_id = $_SESSION['id'];
$query = "SELECT * FROM system_user WHERE id=$user_id";
$result = mysqli_query($con, $query);
$row = mysqli_fetch_assoc($result);
$doj = $row['doj']; 
$contact_error = "";
// Handle form submission
// if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (isset($_POST['submit'])) {
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];
    // $doj = $_POST['doj'];
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }

    if (strlen($_POST['contact_number']) !== 10) {
        $contact_error = "⚠️ Contact mumber should be exactly 10 digits";
    }

    if (empty($contact_error)) {
        if (isset($_POST['gender'])) {
            $query = "UPDATE system_user SET full_name='$full_name', contact_number='$contact_number', doj='$doj', gender='$gender' WHERE id=$user_id";
        } else {
            $query = "UPDATE system_user SET full_name='$full_name', contact_number='$contact_number', doj='$doj'WHERE id=$user_id";
        }

        $result = mysqli_query($con, $query);

        if ($result) {
            echo "<div class='alert_success'>✅Your profile details have been updated successfully!
        Click on Ok to continue<a href='$redirect'><button class='ok_button' style=margin-left:5px>Ok</button></a></div>";
        } else {
            echo '<div class="alert_error">⚠️something went wrong</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="editpro-design.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <style>
        .cancel {
            border-color: #333;
            background-color: #333;
            /* background-color: #dc3545;
            border-color: #dc3545; */
            margin-top: 20px;
            width: 100px;
            height: 30px;
            color: white;
            font-size: 15px;
            border-radius: 3px;
            margin-left: 250px;
        }

        .cancel:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            /* transform: scale(1.105); */
        }
    </style>
</head>

<body>
    <div class="full-part">
        <div class="left-section">
            <img src="avathar.jpeg" alt="Profile">
            <h2 style="font-family:serif; font-style: italic;"><b>It's time to update.</b></h2>
            <p>Stay updated , keep your profile in sync with you , make quick edits in just 5 seconds!</p>
        </div>
        <div class="right-section">
            <center>
                <h1><i>Edit Profile</i></h1>
                <div class="input_adjust">
                    <form method="post" autocomplete="off">
                        <table>
                            <tr>
                                <td>
                                    <label>Name<span style="color: red;"> *</span></label>
                                    <div class="input-container">
                                        <input class="line" type="text" name="full_name" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Contact No<span style="color: red;"> *</span></label>
                                    <div class="input-container">
                                        <input class="line" type="text" name="contact_number" required>
                                    </div>
                                    <span style="color:red"><?php echo $contact_error; ?></span>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Registration Date</label>
                                    <div class="input-container">
                                    <input class="line" type="date" name="doj" value="<?php echo $doj; ?>" readonly>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Gender</label>
                                    <div class="gender-container">
                                        <input type="radio" name="gender" value="Male"> <i class="fa-solid fa-mars"></i>
                                        Male
                                        <input type="radio" name="gender" value="Female"> <i
                                            class="fa-solid fa-venus"></i> Female
                                        <input type="radio" name="gender" value="Other"> <i
                                            class="fa-solid fa-mars-stroke"></i> Other
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <!-- <input type="submit" class="submit" value="Update" name="submit"> -->
                                    <button type="button" class="cancel" style="margin-left:140px;margin-right:10px"
                                        name="cancel" onclick='window.location.href="<?php echo $redirect;?>";'>
                                        Cancel
                                    </button><input type="submit" class="submit" style="margin-left:-1px" value="Update"
                                        name="submit">
                                    <!-- <input type="submit" class="submit" style="margin-left:-1px"value="Update" name="submit"><input type="submit" class="submit" style="margin-left:-1px"value="Update" name="submit"> -->
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </center>
        </div>
    </div>
</body>

</html>

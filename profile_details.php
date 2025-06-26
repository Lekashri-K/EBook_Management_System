<?php
session_start();
include("configuration.php");
$contact_error = "";
if (isset($_SESSION['id'])) {
    $session_userid = $_SESSION['id'];

}
// $gender = $_POST['gender'];
// print $gender;
if (isset($_POST['submit'])) {
    // $name = $_POST['name'];
    $full_name = $_POST['full_name'];
    $contact_number = $_POST['contact_number'];
    if (isset($_POST['gender'])) {
        $gender = $_POST['gender'];
    }
    // $profile_pic = $_FILES['profile_pic'];
    $doj = $_POST['doj'];
    if (strlen($_POST['contact_number']) !== 10) {
        $contact_error = "⚠️ Contact mumber should be exactly 10 digits";
    }

    if (empty($contact_error)) {
        if (isset($_POST['gender'])) {
            $query = "update system_user set full_name='$full_name',contact_number='$contact_number',
        doj='$doj',gender='$gender' where id= '$session_userid'";
        } else {
            $query = "update system_user set full_name='$full_name',contact_number='$contact_number',
        doj='$doj' where id= '$session_userid'";
        }

        $result = mysqli_query($con, $query);
        if ($result) {
            $_SESSION['full_name'] = $full_name;
            // echo "fullname". $_SESSION['full_name'];
            echo '<div class="alert_success">✅Your profile details have been successfully saved!
        Click on Ok to continue<a href="login.php"><button class="ok_button" style=margin-left:5px>Ok</button></a></div>';


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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="profile-details.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <div class="full-part">


        <div class="left-section">
            <img src="avathar.jpeg">
            <br><br>
            <h2 style="font-family:serif; font-style: italic;"><b>Let's get you set up</b></h2>
            <p>It only take couple of seconds to sync up , let's get your profile set and start exploring!</p>

            <!-- <button class="next-btn" >></button> -->
        </div>

        <div class="right-section">
            <center>
                <i>
                    <h1>Profile Details</h1>
                </i>
                <div class="input_adjust">
                    <form action="profile_details.php" method="post" autocomplete="off" enctype="multipart/form-data">
                        <table>
                            <tr>
                                <td>
                                    <label>Name<span style="color: red;"> *</span></label>
                                    <div class="input-container">
                                        <input class="line" type="text" class="line" name="full_name" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Contact No<span style="color: red;"> *</span></label>
                                    <div class="input-container">
                                        <input class="line" type="number" class="line" name="contact_number" required>
                                    </div>
                                    <span style="color:red"><?php echo $contact_error; ?></span>
                                    
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Registration Date<span style="color: red;"> *</span></label>
                                    <div class="input-container">
                                        <input class="line" type="date" class="line" name="doj" required>
                                    </div>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <label>Gender</label>
                                    <div class="gender-container">
                                        <input type="radio" name="gender" value="Male"><i class="fa-solid fa-mars"></i> Male
                                        <input type="radio" name="gender"value="Female"><i class="fa-solid fa-venus"></i>
                                        Female
                                        <input type="radio" name="gender"value="Other"><i
                                            class="fa-solid fa-mars-stroke"></i> Other
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <input type="submit" class="submit" value="submit" name="submit"></input>
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
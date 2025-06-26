
<?php
include("configuration.php");
$name_error = "";
$con_password_error = "";
$contact_error="";
$password_error="";
$email_error="";
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['conpassword'];
    $contact_no = $_POST['mobileno'];
    $role = 'user';
    $name=trim($name);
    $name=htmlspecialchars($name);
    //username validation
    $query_no1="Select * from system_user where name='$name'";
    $query_result_no1=mysqli_query($con,$query_no1);
    $query_no2="Select * from system_user where email='$email'";
    $query_result_no2=mysqli_query($con,$query_no2);
    if (!preg_match("/^[A-Za-z]/", $name)) {
        $name_error = "⚠️ Username must start  with a letter.";
    }

    elseif (!preg_match("/^[A-Za-z0-9_]+$/", $name)) {
        $name_error = "⚠️ Username can contain only letters,numbers and underscore.";
    }
    elseif(strlen($name)<3||strlen($name)>21) {
        $name_error = "⚠️ Username must be between 4 and 20 characters.";
    }
    
    elseif(mysqli_num_rows($query_result_no1)>0)
    {
       $name_error="⚠️ Username already taken.Please choose another.";
    }
    //email validation
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
        $email_error="⚠️ Invalid email format";
    }
    //password validation
    if(strlen($password)<8)
    {
        $password_error="⚠️ Atleast 8 digits";
    }
    elseif(!preg_match("#[0-9]+#",$password))
    {
        $password_error="⚠️ Atleast one digit";
    }
    elseif(!preg_match("#[a-z]+#",$password))
    {
        $password_error="⚠️ Atleast one small char";
    }
    elseif(!preg_match("#[A-Z]+#",$password))
    {
        $password_error="⚠️ Atleast one upper case";
    }
    if (!preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) 
    {
        $password_error="⚠️ Atleast one special character.";
    }
    
    //confirm_password validation
    if ($_POST['password'] !== $_POST['conpassword']) {
        $con_password_error = "⚠️ Password does not match";
    }
    //mobileno validation
    if (strlen($_POST['mobileno']) !== 10) {
        $contact_error="⚠️ Contact mumber should be exactly 10 digits";
    }
    //assign role
    if ($_POST['email'] === 'EbookGalaxy@gmail.com') {
        $role = 'admin';
    }
    $hashed_password=password_hash($password,PASSWORD_DEFAULT);
    if ((empty($name_error))&&(empty($email_error))&&(empty($password_error))&&(empty($con_password_error)) &&(empty($contact_error))) {
        $result = mysqli_query(
            $con,
            "insert into system_user values('','$name','$email','$hashed_password','$contact_no','$role')"
        );
        if ($result) {
            echo '<div class="alert_success">✅Registered Successfully!Dive into a world of books.Click on Ok to continue<a href="index.php"><button class="ok_button" style=margin-left:5px>Ok</button></a></div>';
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
    <link rel="stylesheet" href="sample2.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body >
    <center>
        <div class="reg_color">
            <h1>Register</h1>

            <form action="register.php" method="post">

                <table>
                    <tr>
                        <td>
                            <div class="star_align">
                                <span style="color:red ; margin-top:10px"> *</span>
                                <div class="input-container">

                                    <input class="line" type="text" placeholder="Username" name="name" required>
                                    <span class="error-message"><?php echo $name_error; ?></span>
                                </div>
                            </div>

                        </td>
                        <td>
                            <i class="icon-adjust fa-solid fa-user"></i>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <div class="star_align">
                                <span style="color:red ; margin-top:10px"> *</span>
                                <div class="input-container">

                                    <input class="line" type="email" placeholder="Email (If admin use company email)"
                                        name="email" required>
                                    <span class="error-message"><?php echo $email_error; ?></span>
                                </div>
                            </div>

                        </td>
                        <td>
                            <i class="icon-adjust fa-solid fa-envelope"></i>
                        </td>
                    <tr>

                        <td>
                            <div class="star_align">
                                <span style="color:red ; margin-top:10px"> *</span>
                                <div class="input-container">

                                    <input class="line" type="password" placeholder="password" name="password" required>
                                    <span class="error-message"><?php echo $password_error; ?></span>
                                </div>
                            </div>

                        </td>
                        <td>
                            <i class="icon-adjust fa-solid fa-lock"></i>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <div class="star_align">
                                <span style="color:red ; margin-top:10px"> *</span>
                                <div class="input-container">

                                    <input class="line" type="password" placeholder="Confirm password"
                                        name="conpassword" required>
                                    <span class="error-message"><?php echo $con_password_error; ?></span>
                                </div>
                            </div>

                        </td>
                        <td>
                            <i class="icon-adjust fa-solid fa-key"></i>
                        </td>
                    </tr>
                    <tr>

                        <td>
                            <div class="star_align">
                                <span style="color:red ; margin-top:10px"> *</span>
                                <div class="input-container">

                                    <input class="line" type="number" placeholder="Contact no" name="mobileno" required>
                                    <span class="error-message"><?php echo $contact_error; ?></span>
                                </div>
                            </div>

                        </td>
                        <td>
                            <i class="icon-adjust fa-solid fa-phone"></i>
                        </td>

                    </tr>
                    
                    <tr>
                        <td>
                            <input type="submit" class="register" value="Register" name="submit"></input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                            <p style="margin-left:11px;margin-top:10px">Already have an account? <a
                            href="login.php">Login</a></p>
                            </center>
                            
                        </td>
                    </tr>
                </table>
    </center>
    </form>
    </div>

</bod>


</html>
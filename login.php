<?php
include("configuration.php");

session_start();
if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $password = ($_POST['password']);
    $sql = "SELECT * FROM system_user WHERE name='$name'";
    $result = mysqli_query($con, $sql);
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_assoc($result);
        $check = $row['password'];
        // $check = password_verify($password, $row['password']);
        if ($row['name'] === $name && $check == $password) {
            // if ($row['email'] === $email && $password===$row['password']) {
            $_SESSION['name'] = $row['name'];
            $_SESSION['id'] = $row['id'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['full_name'] = $row['full_name'];
            // echo "fullname". $_SESSION['full_name'];
            if ($row['role'] == 'user') {
                if (isset($_SESSION['redirect_back'])) {
                    $redirect = $_SESSION['redirect_back'];
                } else {
                    $redirect = 'index.php';
                }
                unset($_SESSION['redirect_back']);
                //     echo '<div class="alert_success">✅ You have successfully logged in ! Welcome back . 
                // Click ok to proceed <a href="index.php">
                // <button class="ok_button" style=margin-left:5px>Ok</button></a></div>';
                echo "<div class='alert_success'>✅ You have successfully logged in ! Welcome back. 
Click ok to proceed <a href='$redirect'>
<button class='ok_button' style='margin-left:5px'>Ok</button></a></div>";
            } else {
                
                echo '<div class="alert_success">✅ You have successfully logged in ! Welcome back . 
            Click ok to proceed <a href="admin.php">
            <button class="ok_button" style=margin-left:5px>Ok</button></a></div>';
            }


        } else {
            echo '<div class="alert_error">❌ Invalid username or password . Please check and enter again or register for a new account !</div>';
        }
    } else {
        echo '<div class="alert_error">❌ Invalid username or password . Please check and enter again or register for a new account !</div>';
    }

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css?v=<?php echo time(); ?>">
</head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
    integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

<body style="background-image: url('bk.jpeg');
                background-repeat:no-repeat;
                background-size:contain;
                background-position:center;
                background-size:100%;">
    <center>
        <div class="reg_color">


            <form action="login.php" method="post" autocomplete="off">
                <table>
                    <center>
                        <img src="login.jpeg" style="width:110px;height:110px;border-radius:60%;margin-top:5px" />
                        <br>
                    </center>
                    <h1>Login</h1>

                    <tr>
                        <td><span style="color:red"> *</span><input class="line" type="name" name="name"
                                placeholder="User name" required></td>
                        <td><i class=" icon-adjust fa-solid fa-envelope"></i></td>
                    <tr>
                        <td><span style="color:red"> *</span><input class="line" type="password" name="password"
                                placeholder="Password" required>
                        </td>
                        <td><i class=" icon-adjust fa-solid fa-lock"></i></td>
                    </tr>
                    <style>
                        .submit:hover {
                            transform: scale(1.05);
                        }
                    </style>
                    <tr>
                        <td style="text-align: center;">
                            <input type="submit" class="submit" value="Login" name="submit"
                                style="   transition: transform 0.2s ease, filter 0.2s ease;"></input>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <center>
                                <p style="margin-left:11px ;margin-top:10px">Don't have an account? <a
                                        href="register.php">Register</a></p>
                            </center>

                        </td>
                    </tr>
                </table>
            </form>
    </center>
    </div>
</body>

</html>
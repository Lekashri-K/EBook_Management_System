<?php
session_start();
session_destroy();
if(isset($_SESSION["redirect_after_login"])){
    $redirect=$_SESSION["redirect_after_login"];
}
/*admin page la irunthu varathuku*/
else if(isset($_SESSION["redirect_back"])){
    $redirect=$_SESSION["redirect_back"];
}
else{
    $redirect='index.php';
}
header("Location:$redirect");

exit();
?>
<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$databasename = 'ebook';
try{
    $con = mysqli_connect($hostname, $username, $password, $databasename);
}
catch(mysqli_sql_exception $e)
{
    die("Connection Failed :".$e->getMessage());
}
?>


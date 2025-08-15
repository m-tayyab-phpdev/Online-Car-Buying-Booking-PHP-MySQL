<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "gigawheels";
$con = mysqli_connect($host, $user, $password, $db);
if(!($con)){
    die($con).
    mysqli_close($con);
}

?>
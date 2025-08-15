<?php
session_start();
include_once 'connection.php';
include_once 'redirect.php';
if (isset($_POST['btn-upload'])) {
   $title = mysqli_real_escape_string($con, $_POST['title']);
   $brand = mysqli_real_escape_string($con, $_POST['brand']);
   $modal = mysqli_real_escape_string($con, $_POST['modal']);
   $year = mysqli_real_escape_string($con, $_POST['year']);
   $mileage = mysqli_real_escape_string($con, $_POST['mileage']);
   $fuel = mysqli_real_escape_string($con, $_POST['fuel']);
   $gear = mysqli_real_escape_string($con, $_POST['gearbox']);
   $power = mysqli_real_escape_string($con, $_POST['power']);
   $doors = mysqli_real_escape_string($con, $_POST['doors']);
   $seats = mysqli_real_escape_string($con, $_POST['seats']);
   $color = mysqli_real_escape_string($con, $_POST['color']);
   $duties = mysqli_real_escape_string($con, $_POST['duties']);
   $price = mysqli_real_escape_string($con, $_POST['price']);
   $details = mysqli_real_escape_string($con, $_POST['details']);
   $path = $_FILES['image']['name'];
   $fakepath = $_FILES['image']['tmp_name'];
   $size = $_FILES['image']['size'];
   $type = $_FILES['image']['type'];
   $folder = "uploads/";
   $uniquename = uniqid() . $path;
   $fullpath = $folder . $uniquename;
   if (!(move_uploaded_file($fakepath, $fullpath))) {
      redirect("Server error", "danger", "cars.php");
   }
   $serial = "GW-" . rand(10000, 99999);
   $sql = mysqli_query($con, "INSERT INTO `cars`(`cartitle`, `carbrand`, `carmodal`, `carmodalyear`, `carmileage`, `carfuel`, `cargears`, `carpower`, `cardoors`, `carseats`, `carcolor`, `carimage`, `cardetails`, `serial`, `carprice`, `carduties`) VALUES ('$title','$brand','$modal','$year','$mileage','$fuel','$gear','$power','$doors','$seats','$color','$fullpath','$details', '$serial', '$price', '$duties')");

   if ($sql) {
      redirect("New Car Added", "success", "inventory.php");
   } else {
      redirect("Server error", "danger", "cars.php");
   }
}

if (isset($_POST['btn-update'])) {
   $title = mysqli_real_escape_string($con, $_POST['title']);
   $brand = mysqli_real_escape_string($con, $_POST['brand']);
   $modal = mysqli_real_escape_string($con, $_POST['modal']);
   $year = mysqli_real_escape_string($con, $_POST['year']);
   $mileage = mysqli_real_escape_string($con, $_POST['mileage']);
   $fuel = mysqli_real_escape_string($con, $_POST['fuel']);
   $gear = mysqli_real_escape_string($con, $_POST['gearbox']);
   $power = mysqli_real_escape_string($con, $_POST['power']);
   $doors = mysqli_real_escape_string($con, $_POST['doors']);
   $seats = mysqli_real_escape_string($con, $_POST['seats']);
   $color = mysqli_real_escape_string($con, $_POST['color']);
   $duties = mysqli_real_escape_string($con, $_POST['duties']);
   $price = mysqli_real_escape_string($con, $_POST['price']);
   $details = mysqli_real_escape_string($con, $_POST['details']);
   $carid = mysqli_real_escape_string($con, $_POST['carid']);
   $path = $_FILES['image']['name'];
   $fakepath = $_FILES['image']['tmp_name'];
   $size = $_FILES['image']['size'];
   $type = $_FILES['image']['type'];
   $folder = "uploads/";
   $uniquename = uniqid() . $path;
   $fullpath = $folder . $uniquename;
   if (!(move_uploaded_file($fakepath, $fullpath))) {
      redirect("Server error", "danger", "cars.php");
   }
   $sql = mysqli_query($con, "UPDATE `cars` SET 
    `cartitle` = '$title', 
    `carbrand` = '$brand', 
    `carmodal` = '$modal', 
    `carmodalyear` = '$year', 
    `carmileage` = '$mileage', 
    `carfuel` = '$fuel', 
    `cargears` = '$gear', 
    `carpower` = '$power', 
    `cardoors` = '$doors', 
    `carseats` = '$seats', 
    `carcolor` = '$color', 
    `carimage` = '$fullpath', 
    `cardetails` = '$details',
    `carprice` = '$price',
    `carduties` = '$duties' 
WHERE `carid` = '$carid'");


   if ($sql) {
      redirect("Inventory Updated", "success", "inventory.php");
   } else {
      redirect("Server error", "danger", "cars.php");
   }
}

if (isset($_GET['id'])) {
   $id = mysqli_real_escape_string($con, $_GET['id']);
   $sql = mysqli_query($con, "DELETE FROM `cars` WHERE `carid` = '$id'");
   if ($sql) {
      redirect("Car Record Deleted", "success", "inventory.php");
   } else {
      redirect("Server error", "danger", "cars.php");
   }
}


if (isset($_GET['status']) && isset($_GET['car'])) {
   $carstatus = mysqli_real_escape_string($con, $_GET['status']);
   $car = mysqli_real_escape_string($con, $_GET['car']);
   if($carstatus == "n/a"){
      $change = "0";
   }else{
      $change = "1";
   }
   $sql = mysqli_query($con, "UPDATE `cars` SET `status` = '$change' WHERE `carid` = '$car'");
   if ($sql) {
      redirect("Car status updated", "success", "inventory.php");
   } else {
      redirect("Server error", "danger", "cars.php");
   }
}

?>

<?php
session_start();
include_once 'connection.php';
include_once 'redirect.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


if (isset($_POST['btn-book'])) {

function EMAILAPI($useremail, $username){
    require 'PHPMailer/Exception.php';
    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';


$mail = new PHPMailer(true);

try {
    $mail->isSMTP();                                            
    $mail->Host       = 'smtp.gmail.com';                     
    $mail->SMTPAuth   = true;                                   
    $mail->Username   = 'gradcodex@gmail.com';                     
    $mail->Password   = 'ahcr iikb wkep dqmo';                              
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            
    $mail->Port       = 465;                                    

    $mail->setFrom('gradcodex@gmail.com', 'Giga Wheels');
    $mail->addAddress($useremail, $username);     




    $mail->isHTML(true);                                
    $mail->Subject = 'Giga Wheel Booking Confirmation';
    $mail->Body = '
    <!DOCTYPE html>
    <html>
    <head>
        <style>
            .card {
                max-width: 600px;
                margin: auto;
                border: 1px solid #e0e0e0;
                border-radius: 10px;
                box-shadow: 0 4px 10px rgba(0,0,0,0.1);
                font-family: Arial, sans-serif;
            }
            .card-header {
                background-color: #007bff;
                color: white;
                padding: 15px;
                border-top-left-radius: 10px;
                border-top-right-radius: 10px;
                text-align: center;
                font-size: 20px;
            }
            .card-body {
                padding: 20px;
                color: #333;
            }
            .card-footer {
                background-color: #f8f9fa;
                padding: 15px;
                text-align: center;
                font-size: 14px;
                color: #666;
                border-bottom-left-radius: 10px;
                border-bottom-right-radius: 10px;
            }
        </style>
    </head>
    <body>
        <div class="card">
            <div class="card-header">
                Booking Confirmed!
            </div>
            <div class="card-body">
                <p>Dear <strong>' . htmlspecialchars($username) . '</strong>,</p>
                <p>Your car booking has been successfully confirmed. Thank you for choosing our service!</p>
                <p>We’re excited to assist you on buy new car. A representative will reach out to you shortly with the complete details.</p>
                <p>Feel free to contact us if you have any questions or need further assistance.</p>
                <p style="margin-top: 30px;">Safe travels!<br><strong>The Giga Wheels Team</strong></p>
            </div>
            <div class="card-footer">
                © ' . date('Y') . ' Giga Wheels. All rights reserved.
            </div>
        </div>
    </body>
    </html>';

    $mail->send();
    return 1;
} catch (Exception $e) {
    return 0;
}

}



    $user = $_SESSION['ID'];
    $useremail = mysqli_real_escape_string($con, $_POST['email']);
    $username = mysqli_real_escape_string($con, $_POST['name']);
    $carid = mysqli_real_escape_string($con, $_POST['carid']);
    $amount = mysqli_real_escape_string($con, $_POST['price']);
    $city = mysqli_real_escape_string($con, $_POST['city']);
    $address = mysqli_real_escape_string($con, $_POST['address']);
    $plan = mysqli_real_escape_string($con, $_POST['plan']);
    if ($plan == "Installment") {
        $installment = mysqli_real_escape_string($con, $_POST['installment']);
    } else {
        $installment = "Full Payemnt";
    }
    $paytype = mysqli_real_escape_string($con, $_POST['paymentType']);
    $usercontact = mysqli_real_escape_string($con, $_POST['contact']);
    $path = $_FILES['img']['name'];
    $fakepath = $_FILES['img']['tmp_name'];
    $size = $_FILES['img']['size'];
    $type = $_FILES['img']['type'];
    $folder = "../admin/php/uploads/";
    $unique_name = uniqid() . $path;
    $fullpath = $folder . $unique_name;
    if (!(move_uploaded_file($fakepath, $fullpath))) {
        redirect("Error While Uploading Media", "danger", "booking.php");
    }
    $sql = $con->prepare("INSERT INTO `bookings`(`userid`, `carid`, `amount`, `city`, `address`, `plan`, `installment`, `type`, `usercontact`, `userimage`) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $sql->bind_param("iiisssssss", $user, $carid, $amount, $city, $address, $plan, $installment, $paytype, $usercontact, $unique_name);
    if ($sql->execute()) {
        $bookid = mysqli_insert_id($con);
        $delivery = mysqli_query($con, "INSERT INTO `deliveries` (`bookid`) VALUE ('$bookid')");
        if($delivery){
            $sql->close();
        }
        if(EMAILAPI($useremail, $username)){
            redirect("Booking Confirmation Email has been sent to you", "success", "booking.php?car=$carid");
        }else{
            redirect("Error While sending Email", "danger", "booking.php?car=$carid");
        }
    } else {
        $sql->close();
        redirect("Internal Server Error", "danger", "booking.php?car=$carid");
    }
}

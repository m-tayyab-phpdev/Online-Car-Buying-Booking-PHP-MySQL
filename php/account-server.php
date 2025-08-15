<?php
session_start();
include_once 'connection.php';
include_once 'redirect.php';
if (isset($_POST['btn-login'])) {
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $sql = mysqli_query($con, "SELECT * FROM `users` WHERE `email` = '$email'");
    if ($sql && mysqli_num_rows($sql) == "1") {
        $row = mysqli_fetch_assoc($sql);
        if (password_verify($password, $row['password'])) {
            if ($row['type'] == "1") {
                $_SESSION['ID'] = $row['id'];
                $_SESSION['NAME'] = $row['name'];
                header('location:../index.php');
            } elseif ($row['type'] == "0") {
                $_SESSION['ID'] = $row['id'];
                $_SESSION['NAME'] = $row['name'];
                header('location:../admin/dashboard.php');
            } else {
                redirect("Invalid usertype", "danger", "account.php");
            }
        } else {
            redirect("Invalid email/password", "danger", "account.php");
        }
    } else {
        redirect("Invalid email/password", "danger", "account.php");
    }
}

if (isset($_POST['btn-register'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email =  mysqli_real_escape_string($con, $_POST['email']);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        redirect("Wrong Email Formate", "danger", "account.php");
        exit();
    }
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $cpassword = mysqli_real_escape_string($con, $_POST['cpassword']);
    $type = 1;
    if (!(empty($name) || empty($email) || empty($password) || empty($cpassword))) {
        if ($password === $cpassword) {
            $check = $con->prepare("SELECT `email` FROM `users` WHERE `email` = ?");
            $check->bind_param("s", $email);
            if ($check->execute()) {
                $result = $check->get_result();
                if ($result->num_rows == 0) {
                    $check->close();
                    if($hash = password_hash($password, PASSWORD_DEFAULT)){
                        $stmt = $con->prepare("INSERT INTO `users` (`name`, `email`, `password`, `type`) VALUES (?, ?, ? ,?)");
                        $stmt->bind_param("sssi", $name, $email, $hash, $type);
                        if($stmt->execute()){
                            redirect("Thankyou for registeration", "success", "account.php");
                            $stmt->close();
                        }else{
                            redirect("Database in not responding", "danger", "account.php");
                        }
                    }else{
                        redirect("Error while encryption", "warning", "account.php");
                    }
                } else {
                    $check->close();
                    redirect("Email Already Registered", "info", "account.php");
                }
            } else {
                redirect("Database in not responding", "danger", "account.php");
            }
        } else {
            redirect("Passwords not matched", "danger", "account.php");
        }
    } else {
        redirect("Fill the required fields", "danger", "account.php");
    }
}
?>
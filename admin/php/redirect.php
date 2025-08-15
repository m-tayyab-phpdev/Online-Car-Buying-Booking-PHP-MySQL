<?php
function redirect($message, $color, $page){
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
$_SESSION['MSG'] = $message;
$_SESSION['COLOR'] = $color;
header('location:../'.$page.'');
}
?>
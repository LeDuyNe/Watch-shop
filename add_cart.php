<?php
session_start();
include_once('./config.php');
$MSHH = $_GET['MSHH'];
if(isset($_SESSION['giohang'][$MSHH])){
    $_SESSION['giohang'][$MSHH] = $_SESSION['giohang'][$MSHH] + 1;
    
}else{
    $_SESSION['giohang'][$MSHH] = 1;
}
header('location: ./index.php');

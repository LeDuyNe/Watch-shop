<?php
    session_start();
    if(isset($_GET['MSHH'])){   
        $id = $_GET['MSHH'];    
       if($id == 1){
        unset($_SESSION['giohang']);
        header('location:./index.php');  
       }else{
        $MSHH = $_GET['MSHH'];
        unset($_SESSION['giohang'][$MSHH]);
        header('location:./cart.php'); 
       }
    }else{ 
        header('location:./cart.php');  
    }
?>

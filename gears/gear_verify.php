<?php
include "../cores/inc/config.php";
session_start();

if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_SESSION["$sys_session"]) || $_SESSION["$sys_session"] !== true){
        $email_id=htmlspecialchars($_POST['email_id']);
        $otp = htmlspecialchars($_POST['otp']);
        $email_id=mysqli_real_escape_string($link,$email_id);
        $otp= mysqli_real_escape_string($link,$otp);
        $sql="SELECT * FROM `employee_tbl` WHERE `email_id`='$email_id' and `otp`='$otp'";
        if($result =mysqli_query($link, $sql)){
            if(mysqli_num_rows($result) >0 ) {
                echo 1;  
            }else
                echo 2;
        }
    }else{
        $e_id =  htmlspecialchars($_SESSION["e_id"]);
        $otp = htmlspecialchars($_POST['otp']);
        $otp= mysqli_real_escape_string($link,$otp);
        $sql = "UPDATE `employee_tbl` SET `email_status`='done' WHERE `e_id`= $e_id and `otp`='$otp'";
        if($result =mysqli_query($link, $sql)){
            if(mysqli_affected_rows($link)>0 ) {
                $_SESSION['email_status']= "done";
                echo 1;  
            }else
                echo 2;
        }  
    }    
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);

?>
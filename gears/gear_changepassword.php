<?php
include "../cores/inc/config.php";


if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email_id = htmlspecialchars($_POST['email_id']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);

    $email_id = mysqli_real_escape_string($link,$email_id);
    $password = mysqli_real_escape_string($link,$password);
    $confirm_password = mysqli_real_escape_string($link,$confirm_password);

    if($password==$confirm_password){
        $password=password_hash($password, PASSWORD_DEFAULT);
    }

    $sql = "UPDATE `employee_tbl` SET `password`= '$password' WHERE `email_id`= '$email_id' ";
    if(mysqli_query($link, $sql)){
            if(mysqli_affected_rows($link)>0) 
                echo 1;  
            else
                echo 2;
        }
    }
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>
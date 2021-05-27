<?php
include "../cores/inc/config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $email_id = htmlspecialchars($_POST['email_id']);
    $email_id = mysqli_real_escape_string($link,$_POST['email_id']);
    $sql = "SELECT * FROM `employee_tbl` WHERE email_id = '$email_id' ";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) == 0)
            echo 1;
        elseif(mysqli_num_rows($result)==1)
            echo 10;    
        else
            echo 2;
    }
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>
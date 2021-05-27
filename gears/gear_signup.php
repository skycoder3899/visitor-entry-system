<?php
include "../cores/inc/config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email_id = htmlspecialchars($_POST['email_id']);
    $dep = htmlspecialchars($_POST['department']);
    $password = htmlspecialchars($_POST['password']);
    $confirm_password = htmlspecialchars($_POST['confirm_password']);
    $phone=htmlspecialchars($_POST['phone']);
    $time = htmlspecialchars($_POST["time"]);
    $date = htmlspecialchars($_POST['date']);
    $stats='active';

    $fname = mysqli_real_escape_string($link,$fname);
    $lname = mysqli_real_escape_string($link,$lname);
    $email_id = mysqli_real_escape_string($link,$email_id);
    $dep = mysqli_real_escape_string($link,$dep);
    $password = mysqli_real_escape_string($link,$password);
    $confirm_password = mysqli_real_escape_string($link,$confirm_password);
    $phone=mysqli_real_escape_string($link,$phone);

    if($password==$confirm_password){
        $password=password_hash($password, PASSWORD_DEFAULT);
    }

    $salutation=$_POST['salutation'];
    $otp = rand(100000,999999);

    $sql="INSERT INTO `employee_tbl`(`e_stats`, `salutation`, `f_name`, `l_name`, `phone`, `email_id`, `password`, `department_id`, `otp`, `time`, `joining_date`) VALUES ('$stats','$salutation','$fname','$lname','$phone','$email_id','$password','$dep','$otp','$time','$date')";
    if (mysqli_query($link, $sql)) {
        echo 1;
    }
    else 
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
else
    echo "You are not allowed to access this page"; 
mysqli_close($link);
?>
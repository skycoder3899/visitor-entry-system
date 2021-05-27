<?php
include "../cores/inc/config.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    date_default_timezone_set('Asia/Kolkata');

    $employee_type=htmlspecialchars($_POST['employee_type']);
    $employee_title=htmlspecialchars($_POST['employee_title']);
    $dataOfBirth=htmlspecialchars($_POST['dataOfBirth']);
    $pincode=htmlspecialchars($_POST['pincode']);
    $city=htmlspecialchars($_POST['city']);
    $Country=htmlspecialchars($_POST['Country']);
    $State=htmlspecialchars($_POST['State']);
    $Address=htmlspecialchars($_POST['Address']);
    $e_id = htmlspecialchars($_SESSION["e_id"]);

    $dataOfBirth = mysqli_real_escape_string($link,$dataOfBirth);
    $pincode = mysqli_real_escape_string($link,$pincode);
    $Address=$Address.','.$city.'PIN-'.$pincode.','.$State.','.$Country;
     $Address=mysqli_real_escape_string($link,$Address);
    $time=date('d-m-Y h:i:sa');
    
     $sql = "INSERT INTO `employee_basic_tbl`(`e_id`, `employee_title`, `working_type`,`dob`, `address`,`data_timestamp`) VALUES ($e_id,'$employee_title','$employee_type','$dataOfBirth','$Address','$time')";
    if(mysqli_query($link, $sql))
        echo 1;
    else
        echo 2;
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>
<?php
include "../cores/inc/config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $e_id = htmlspecialchars($_POST['e_id']);

    $sql = "UPDATE `employee_tbl` SET `e_stats`= 'unavailable' WHERE `e_id`= '$e_id' ";
    if(mysqli_query($link, $sql)){
        if(mysqli_affected_rows($link)>0){
            echo 'Unavailable';
        }            
        else{
            $sql = "UPDATE `employee_tbl` SET `e_stats`= 'available' WHERE `e_id`= '$e_id' ";
            if(mysqli_query($link, $sql)){
                if(mysqli_affected_rows($link)>0){
                    echo 'Available';
                }
            }
        }
    }
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>
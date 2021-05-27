<?php
include "../cores/inc/config.php";

/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
$link = mysqli_connect($db_host, $db_name , $db_pass, $db_user); 

// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());  
}

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $phone = htmlspecialchars($_POST['phone']);
    $phone = mysqli_real_escape_string($link,$_POST['phone']);
    $sql = "SELECT * FROM user_tbl WHERE phone = '$phone' ";
    if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) == 0)
            echo 1;
        else
            echo 2;
    }
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>
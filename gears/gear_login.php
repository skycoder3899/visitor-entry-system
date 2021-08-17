<?php
include "../cores/inc/config.php";

if($_SERVER["REQUEST_METHOD"] == "POST"){
$email_id = htmlspecialchars($_POST['email_id']);
$password = htmlspecialchars($_POST['password']);
$email_id = mysqli_real_escape_string($link,$_POST['email_id']);
$password = mysqli_real_escape_string($link,$_POST['password']);

if($email_id=='admin@gmail.com' && $password=='admin@123'){
    // Password is correct, so start a new session
    ini_set('session.gc_maxlifetime', 86400);
    ini_set('session.gc_probability', 0);
    ini_set('session.gc_divisor', 100);
    // each client should remember their session id for EXACTLY 21 hour
    session_set_cookie_params(86400);
    session_start();
    // Store data in session variables    
    $_SESSION["admin_id"] = 'done';
    echo 9;
    exit;
}
$sql = "SELECT `e_id`, `e_stats`, `salutation`, `f_name`, `l_name`, `phone`, `email_id`, `password`, `department_id`, `otp`, `email_status`, `time`, `joining_date` FROM `employee_tbl` WHERE email_id = ?";
if($stmt = mysqli_prepare($link, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "s", $param_email_id);
    // Set parameters
    $param_email_id = $email_id;
    if(mysqli_stmt_execute($stmt)){
        // Store result
        mysqli_stmt_store_result($stmt);
        // Check if email_id exists, if yes then verify password
        if(mysqli_stmt_num_rows($stmt) ==1){
            // Bind result variables
            mysqli_stmt_bind_result($stmt,$e_id,$e_stats,$salutation,$f_name,$l_name ,$phone, $email_id, $hashed_password,$department_id,$otp,$email_status,$time,$date);
            if(mysqli_stmt_fetch($stmt)){
                if(password_verify($password, $hashed_password)){
                    // Password is correct, so start a new session
                    ini_set('session.gc_maxlifetime', 86400);
                    ini_set('session.gc_probability', 0);
                    ini_set('session.gc_divisor', 100);
                    // each client should remember their session id for EXACTLY 21 hour
                    session_set_cookie_params(86400);
                    session_start();
                    // Store data in session variables
                    $_SESSION["$sys_session"] = true;
                    $_SESSION["e_id"] = $e_id;
                    $_SESSION["email_id"] = $email_id;
					$_SESSION["e_stats"] = $e_stats;							
					$_SESSION["l_name"] = $l_name;	
					$_SESSION["f_name"] = $f_name;	
					$_SESSION["email_status"] = $email_status;	
					$_SESSION["phone"] = $phone;
				    
                    $sql2="SELECT * FROM `employee_basic_tbl` WHERE e_id=$e_id";
                    if($result = mysqli_query($link,$sql2)){
                        $row = mysqli_fetch_assoc($result);
                        if($row['data_status']===NULL){
                            $_SESSION["basic_status"] = "void";	
                        }
                        else{
                            $_SESSION["basic_status"] = "done";	
                        }
                    }
                    if($email_status != 'done')
                        echo 10;
                    else{
                        $sql = "UPDATE `employee_tbl` SET `e_stats`= 'unavailable' WHERE `e_id`= '$e_id' ";
                        if(mysqli_query($link, $sql)){
                            if(mysqli_affected_rows($link)==0){
                                $sql = "UPDATE `employee_tbl` SET `e_stats`= 'available' WHERE `e_id`= '$e_id' ";
                                if(mysqli_query($link, $sql)){
                                    if(mysqli_affected_rows($link)>0){
                                        echo 1;
                                    }
                                }
                            }            
                        }                        
                        
                    }                           
                }else{
                    echo 2;
                }
            }
        }else{
            echo 3;
        }
    }else{
        echo 4;
    }
mysqli_stmt_close($stmt);
}
else {
    echo "Something's wrong with the query: " . mysqli_error($link);
}
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>
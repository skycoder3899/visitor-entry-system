<?php
include "../cores/inc/config.php";
include '../cores/phpqrcode/qrlib.php';

if($_SERVER["REQUEST_METHOD"] == "POST"){

    date_default_timezone_set("Asia/Calcutta"); 
    
    $path = '../build/img/qrcode/'; 

    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email_id = htmlspecialchars($_POST['email_id']);
    $host_department_id = htmlspecialchars($_POST['host_department_id']);
    $host_id = htmlspecialchars($_POST['host_id']);
    $purpose = htmlspecialchars($_POST['purpose']);
    $phone=htmlspecialchars($_POST['phone']);
    $date = htmlspecialchars($_POST['date']);
    $check_in_time = date("h:i:sa");

    $fname = mysqli_real_escape_string($link,$fname);
    $lname = mysqli_real_escape_string($link,$lname);
    $email_id = mysqli_real_escape_string($link,$email_id);
    $host_department_id = mysqli_real_escape_string($link,$host_department_id);
    $host_id = mysqli_real_escape_string($link,$host_id);
    $purpose = mysqli_real_escape_string($link,$purpose);
    $phone=mysqli_real_escape_string($link,$phone);

    $salutation=$_POST['salutation'];   

    $sql="INSERT INTO `visitor_tbl`(`salutation`, `vf_name`, `vl_name`, `vphone`, `vemail_id`, `purpose`, `host_department_id`, `host_id`, `check_in_time`, `date`) VALUES ('$salutation','$fname','$lname','$phone','$email_id','$purpose','$host_department_id','$host_id','$check_in_time','$date')";
    if (mysqli_query($link, $sql)) {
        $v_id = mysqli_insert_id($link);
            
            
            $file = $v_id.".png"; 
            $sql1 = "UPDATE `visitor_tbl` SET `qrcode`='$file' WHERE v_id=$v_id";
            if(mysqli_query($link, $sql1)){
                if(mysqli_affected_rows($link)>0){

                    $file = $path.$v_id.".png"; 

                // $ecc stores error correction capability('L') 
                    $ecc = 'L'; 
                    $pixel_Size = 10; 
                    $frame_Size = 10; 
        
                // Generates QR Code and Stores it in directory given 
                    QRcode::png($email_id, $file, $ecc, $pixel_Size, $frame_size); 

                    $sq1="SELECT * FROM `employee_tbl` where e_id = '$host_id' ";
                    $re=mysqli_query($link,$sq1);
                    if(mysqli_num_rows($re) > 0){
                        $row = mysqli_fetch_assoc($re);
                        $host_name=$row['f_name'].' '.$row['l_name'];
                        $host_email=$row['email_id'];
                    }
        
                    require '../cores/PHPMailer-5.2-stable/PHPMailerAutoload.php';
                    
                    $name= $fname.' '.$lname;

                    $mail = new PHPMailer;
                    // $mail->SMTPDebug = 4;                               // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = '';                 // SMTP username
                    $mail->Password = '';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
                    $mail->setFrom('', 'VIZHOST');
                    $mail->addAddress($email_id, $name);     // Add a recipient
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Visitor e-Pass';
                    $mail->Body = '<body style="margin: 0; padding: 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="padding: 20px 0 30px 0;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="400"
                            style="border-collapse: collapse; border: 1px solid #cccccc;">
                            <tr>
                                <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
                                <img src="http://visitor.infinityfreeapp.com/build/img/logo.jpg" width="200" height="140" />
                                </td>
                            </tr>
                            <tr>
                                <center><br><h1 style="font-size: 24px; margin: 0;">Visitor e-Pass</h1>
                                <p>Name : '.$name.'<br> Mobile no : '.$phone.'<br> Host Name : '.$host_name.'<br><br><br>
                                        
                                <img src="http://visitor.infinityfreeapp.com/build/img/qrcode/'.$v_id.'.png" width="150" height="110" />
                                </center>
                            </tr>
                            <tr>
                                <center><p>Please click on the link below when you check-out<br/>                       
                                <a href="http://visitor.infinityfreeapp.com/thanks.php?v_id='.$v_id.'">Check-out</a></p></center>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>';

                if(!$mail->send()) {
                    echo 'Errormail';
                } else {
                   $mail = new PHPMailer;
                    // $mail->SMTPDebug = 4;                               // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'davidnit817@gmail.com';                 // SMTP username
                    $mail->Password = 'david1@2';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to
                    $mail->setFrom('davidnit817@gmail.com', 'VIZHOST');
                    $mail->addAddress($host_email, $host_name);     // Add a recipient
                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Visitor Notification';
                    $mail->Body = '<body style="margin: 0; padding: 0;">
            <table role="presentation" border="0" cellpadding="0" cellspacing="0" width="100%">
                <tr>
                    <td style="padding: 20px 0 30px 0;">
                        <table align="center" border="0" cellpadding="0" cellspacing="0" width="400"
                            style="border-collapse: collapse; border: 1px solid #cccccc;">
                            <tr>
                                <td align="center" bgcolor="#70bbd9" style="padding: 40px 0 30px 0;">
                                <img src="http://visitor.infinityfreeapp.com/build/img/logo.jpg" width="200" height="140" />
                                </td>
                            </tr>
                            <tr>
                                <center><br><h1 style="font-size: 24px; margin: 0;">Visitor Notification</h1><br><br>
                                <p>'.$salutation.'. '.$name.' has come to meet you for '.$purpose.'. </p><br><br>
                                </center>
                            </tr>
                            <tr>
                                <td bgcolor="#ee4c50" style="padding: 30px 30px;">
                                    <table border="0" cellpadding="0" cellspacing="0" width="100%"
                                        style="border-collapse: collapse;">
                                        <tr>  
                                            <td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 10px;">
                                                <p style="margin: 0;">&reg; Copyright ©2021 All rights reserved <br />
                                                    <a href="http://visitor.infinityfreeapp.com/login.php" style="color: #ffffff;">VIZHOST</a>
                                                </p>
                                            </td>
                                            <td align="right">
                                                <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse;">
                                                    <tr>
                                                        <td>
                                                            <a href=""><img src="https://assets.codepen.io/210284/tw.gif" width="28" height="28" /></a>
                                                        </td>
                                                        <td style="font-size: 0; line-height: 0;" width="20">&nbsp;</td>
                                                        <td>
                                                            <a href=""><img src="https://assets.codepen.io/210284/fb.gif" width="28" height="28" /></a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
						        </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </body>';
         if(!$mail->send()) {
                    echo 'Errormail';
                } 
            else{
                echo "ok";
            }    
                }
           }
       }
    }
    else 
        echo "Error: " . $sql . "<br>" . mysqli_error($link);
}
else
    echo "You are not allowed to access this page"; 
mysqli_close($link);
?>

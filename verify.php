<?php include "cores/inc/config.php";
    session_start();
    // Check if the user is logged in, if not then redirect him to login page
    if(!isset($_SESSION["$sys_session"]) || $_SESSION["$sys_session"] !== true){
            header("location: ".$sys_link."/login.php");
            exit;
    }
    $done = "done"; 
    if( $_SESSION["email_status"] == $done && $_SESSION["basic_status"] !== $done){
            header("location: ".$sys_link."/basic.php");
            exit;
    }
    if( $_SESSION["email_status"] == $done && $_SESSION["basic_status"] == $done){
            header("location: ".$sys_link."/profile.php");
            exit;
    }
    
    $phone = $_SESSION["phone"];
    $name=$_SESSION["f_name"] .' '. $_SESSION["l_name"] ;	
    $email_id=$_SESSION["email_id"] ;
    $e_id = $_SESSION["e_id"];
    $sql3 = "SELECT `otp` FROM `employee_tbl` WHERE `e_id` = '$e_id'";
    if($result =mysqli_query($link, $sql3)){
        if (mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                $otp =  $row["otp"];
                }
            } 
        }
			require 'cores/PHPMailer-5.2-stable/PHPMailerAutoload.php';

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
			$mail->Subject = 'Employee Verification Code';
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
						<td bgcolor="#ffffff" style="padding: 40px 30px 40px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%"
								style="border-collapse: collapse;">
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif;">
										<h1 style="font-size: 24px; margin: 0;"> Verification Code </h1>
									</td>
								</tr><br>
								<tr>
									<td style="color: #153643; font-family: Arial, sans-serif; font-size: 16px; line-height: 24px; padding: 20px 0 30px 0;">
										<p><h4>Hi&nbsp;'.$name.'&nbsp;,</h4>
											Warm Greetings from VIZHOST. Thank you for signing up.<br>
											Your Verification Code is: '. $otp.' </p>
									</td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td bgcolor="#ee4c50" style="padding: 30px 30px;">
							<table border="0" cellpadding="0" cellspacing="0" width="100%"
								style="border-collapse: collapse;">
								<tr>  
									<td style="color: #ffffff; font-family: Arial, sans-serif; font-size: 10px;">
										<p style="margin: 0;">&reg; Copyright ©2021 All rights reserved <br />
											<p style="color: #ffffff;">VIZHOST</p>
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
            echo "Mailer Error";
		}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sys_name; ?> | Verify</title>
  <?php include "cores/inc/header.php"?>
</head>
<body class="hold-transition login-page" onload="myFunction()" style="background-image: url('build/img/bac4.jpg');background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
    <div class="login-box">
        <div class="login-logo">
            <a href=<?php echo $sys_link; ?>><b>HOST</b></a>
        </div>
        <div id="hj">
        <div class="login-box-body">
            <p class="login-box-msg">OTP verification </p>
            <form method="post" id="verify_form">
            <div class="form-group has-feedback">
                <input id="otp" name="otp" type="password" maxlength="6" minlength="6" class="form-control" pattern="[0-9]+" placeholder="OTP">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8"><p id="message" class='login-box-msg' style='color:red;'></p></div>
                <div class="col-xs-4">
                <button id="submit" type="submit" class="btn btn-primary btn-block btn-flat">Verification</button>
                </div>
            </div>
            </form>
            <a id="resendotp" href="#">Resend OTP</a> |
            <a href="logout.php">Sign in with different account</a> 
        </div> 
    </div>
</div>



<?php 
include "cores/inc/footer.php";  
?>
<script>
    var myVar;
    function myFunction() {
        myVar = setTimeout(showPage, 1);
    }

    function showPage() {
        document.getElementById("loader").style.display = "none";
        document.getElementById("myDiv").style.display = "block";
    }
    $(document).ready(function(){
        var a=false;
        function messerror(x){
            $('#message').fadeIn().html(x);
            setTimeout(function() {
            $('#message').fadeOut("fast");
            }, 5000 );
        }
        $('#resendotp').on('click',function(){
            $.ajax({
                type: 'POST',
                url: 'gears/gear_sendotp.php',
                error:function(){
                    messerror("Something went wrong");
                },
                success: function(response){
                    if(response=='ok')
                        messerror("OTP sent");
                    else
                        messerror("Something went wrong");      
                }
            })
        });             
        $("#verify_form").on('submit', function(e){
            e.preventDefault();
            var otp=$('#otp').val();
            if(otp=='')
                messerror("Enter OTP");
            else if(!a)
                check_otp();       
            else{
                $("#submit").prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: 'gears/gear_verify.php',
                    data: $(this).serialize(),
                    error:function(){
                        messerror("Something went wrong");
                    },
                    success: function(response){
                        if(response==1)
                            window.location.href='<?php echo $sys_link ?>/basic.php';
                        else
                            messerror("wrong OTP");      
                    },
                    complete: function(){
                        $("#submit").prop('disabled', false);
                    }
                });
            }            
        });
        $('#otp').focusout(function () {
            check_otp();
        });
        function check_otp() {
            if( $('#otp').val().length < 6 && $('#otp').val().length != 0 ){
                messerror("Enter a valid OTP");  
                a=false;
            }
            else
                a=true;          
        }
    });
</script>

</body>
</html>

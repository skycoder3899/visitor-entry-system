<?php
include "../cores/inc/config.php";
session_start();
if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(!isset($_SESSION["$sys_session"]) || $_SESSION["$sys_session"] !== true){
        $email_id = $_POST['email_id'];
        $sql = "SELECT * FROM `employee_tbl` WHERE email_id = '$email_id' ";        
        if($result =mysqli_query($link, $sql)){
            if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $name=$row["f_name"] .' '. $row["l_name"] ;	
                        $email_id=$row["email_id"] ;
                        $otp =$row["otp"];
                    }
                } 
            }
			require '../cores/PHPMailer-5.2-stable/PHPMailerAutoload.php';

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
		} else {
            echo 'ok';
		}
    }
    else{
        $email_id = $_SESSION['email_id'];
        $sql = "SELECT * FROM `employee_tbl` WHERE email_id = '$email_id' ";        
        if($result =mysqli_query($link, $sql)){
            if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $name=$row["f_name"] .' '. $row["l_name"] ;	
                        $email_id=$row["email_id"] ;
                        $otp =$row["otp"];
                    }
                } 
            }
			require '../cores/PHPMailer-5.2-stable/PHPMailerAutoload.php';

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
		} else {
            echo 'ok';
		}
}
}
else
    echo "You are not allowed to access this page";
mysqli_close($link);
?>
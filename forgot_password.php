<?php include "cores/inc/config.php";
session_start();
if(isset($_SESSION[$sys_session]) && $_SESSION[$sys_session] === true){
    header("location: ".$sys_link."/profile.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sys_name; ?> | Forgot Password</title>
  <?php include "cores/inc/header.php"?>
</head>
<body class="hold-transition login-page" onload="myFunction()" style="background-image: url('build/img/bac4.jpg');background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
    <div class="login-box">
        <div class="login-box-body" id='forgot_fro'>
             <center><img src="build/img/logo.jpg" width="150px"></center>
            <form method="post" id="forgot_form">
            <div class="form-group has-feedback">
                <input id="email_id" name="email_id" type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8"><p id="message"class='login-box-msg' style='color:red;'></p></div>
                <div class="col-xs-4">
                <button id="submit" type="submit" class="btn btn-primary btn-block btn-flat">Send OTP</button>
                </div>
            </div>
            </form>
            <a href="<?php echo $sys_link;?>/login.php">Login</a> 
        </div>
        <div class="login-box-body" id='otp_fro'>
            <center><img src="build/img/logo.jpg" width="150px"></center>
            <form method="post" id="verify_form">
            <div class="form-group has-feedback">
                <input id="otp_no" name="otp_no" type="password" maxlength="6" minlength="6" class="form-control" pattern="[0-9]+" placeholder="Enter OTP">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8"><p id="otp_message"class='login-box-msg' style='color:red;'></p></div>
                <div class="col-xs-4">
                <button id="submit_otp" type="submit" class="btn btn-primary btn-block btn-flat">Check OTP</button>
                </div>
            </div>
            </form>
            <a href="<?php echo $sys_link;?>/login.php">Login</a> 
        </div>
        <div class="login-box-body" id='password_fro'>
            <center><img src="build/img/logo.jpg" width="150px"></center>
            <form method="post" id="password_form">
            <div class="form-group has-feedback">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8"><p id="pass_message"class='login-box-msg' style='color:red;'></p></div>
                <div class="col-xs-4">
                <button id="submit_password" type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                </div>
            </div>
            </form>
            <a href="<?php echo $sys_link; ?>/login.php">Login</a> 
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
        $('#otp_fro').hide();
        $('#password_fro').hide();
        var a=false,b=false,c=false;
        function messerror(x){
            $('#message').fadeIn().html(x);
            setTimeout(function() {
            $('#message').fadeOut("fast");
            }, 5000 );
        }
        function otperror(x){
            $('#otp_message').fadeIn().html(x);
            setTimeout(function() {
            $('#otp_message').fadeOut("fast");
            }, 5000 );
        }
        function passerror(x){
            $('#pass_message').fadeIn().html(x);
            setTimeout(function() {
            $('#pass_message').fadeOut("fast");
            }, 5000 );
        }
        $("#forgot_form").on('submit', function(e){
            e.preventDefault();
            var email_id=$('#email_id').val();
            if(email_id=='')
                messerror("Enten email id");
            else if(!a)
                check_email();       
            else{
                $("#submit").prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: 'gears/gear_sendotp.php',
                    data:{ email_id: $('#email_id').val() } ,
                    error:function(){
                        messerror("Something went wrong");
                    },
                    success: function(response){
                        if(response=='ok'){
                            $('#forgot_fro').hide();
                            $('#otp_fro').show();
                        }
                        else
                            messerror(response)    
                    },
                    complete: function(){
                        $("#submit").prop('disabled', false);
                    }
                });
            }            
        });
        $('#email_id').focusout(function () {
            check_email();
        });
        function check_email() {
            var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if($('#email_id').val().length !=0){
                if (!(pattern.test($('#email_id').val().toLowerCase()))){
                    a=false;
                    messerror("Invalid email id");
                }
                else{
                    $.ajax({
                        type: 'POST',
                        url: 'gears/gear_checkemail.php',
                        data:{ email_id: $('#email_id').val() } ,
                        error:function(){
                            messerror("Something went wrong");
                        },
                        success: function(response){
                            if(response != 10){
                                messerror("You are not Register");
                                a=false;
                            }
                            else
                                a=true;
                    }
                    });
                }    
            }          
        }
        $("#verify_form").on('submit', function(e){
            e.preventDefault();
            var otp=$('#otp_no').val();
            if(otp=='')
                otperror("Enten OTP");
            else if(!b)
                check_otp();       
            else{
                $("#submit_otp").prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: 'gears/gear_verify.php',
                    data: { email_id: $('#email_id').val() , otp:$('#otp_no').val() },
                    error:function(){
                        otperror("Something went wrong");
                    },
                    success: function(response){
                        if(response==1){
                            $('#otp_fro').hide();
                            $('#password_fro').show();
                        }
                        else
                            otperror("wrong OTP");  
                    },
                    complete: function(){
                        $("#submit_otp").prop('disabled', false);
                    }
                });
            }
        });
        $('#otp_no').focusout(function () {
            check_otp();
        });
        function check_otp() {
            if( $('#otp_no').val().length < 6 && $('#otp_no').val().length != 0 ){
                otperror("Enter a valid OTP");  
                b=false;
            }
            else
                b=true;          
        }
        $("#password_form").on('submit', function(e){
            e.preventDefault();
            var password=$('#password').val();
            var confirm_password=$('#confirm_password').val();
            if(password=='')
                passerror("Enter Password");
            else if(confirm_password=='')
                passerror("Enter confirm Password");
            else if(!c)
                check_password($('#confirm_password').val(),$('#password').val());       
            else{
                $("#submit_password").prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: 'gears/gear_changepassword.php',
                    data:{ email_id: $('#email_id').val(),password:$('#password').val(),confirm_password:$('#confirm_password').val()} ,
                    error:function(){
                        passerror("1Something went wrong");
                    },
                    success: function(response){
                        if(response == 1){
                            $('#email_id').val(" ");
                            window.location.href='<?php echo $sys_link ?>/login.php';
                        }
                        else
                            passerror("Something went wrong");
                    },
                    complete: function(){
                        $("#submit_password").prop('disabled', false);
                    }
                });
            }            
        });
        $('#password').focusout(function () {
            check_password($(this).val(),$('#confirm_password').val());
        });
        $('#confirm_password').focusout(function () {
            check_password($(this).val(),$('#password').val());
        });
        function check_password(x,y) {
            if( x.length < 8 && x.length != 0 ){
                passerror("Password must be least 8 characters");  
                c=false;
            }
            else if(y.length !=0 && (x!=y) ) {
                passerror("Password is Not Match");
                c=false;
            }
            else
                c=true;          
        }
    });
</script>

</body>
</html>

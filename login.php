<?php include "cores/inc/config.php";
session_start();
$done = "done"; 
if(isset($_SESSION["$sys_session"]) && $_SESSION["email_status"] !== $done){
    header("location: ".$sys_link."/verify.php");
    exit;
}
if(isset($_SESSION["$sys_session"]) && $_SESSION["basic_status"] !== $done){
    header("location: ".$sys_link."/basic.php");
    exit;
}
if($_SESSION["basic_status"] == $done && $_SESSION["email_status"] == $done){
   header("location: ".$sys_link."/profile.php");
    exit;
}
if($_SESSION["admin_id"] == $done){
    header("location: ".$sys_link."/dash.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sys_name; ?> | Log in</title>
  <?php include "cores/inc/header.php"?>
  <style>
  #unlock{
      margin-top: 50px;
      display:none;
  }
  </style>
</head>
<body class="hold-transition login-page" onload="myFunction()" style="background-image: url('build/img/bac4.jpg');background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">

<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
    <div class="login-box">
        <!-- <div class="login-logo">
            
             <a href=<?php echo $sys_link; ?>><b>ADMIN & HOST</b></a> 
        </div>-->
        <div id="hj">
        <div class="login-box-body">
            <center><img src="build/img/logo.jpg" width="150px"></center>
            <!-- <p class="login-box-msg">Sign in </p> -->
            <form method="post" id="login_form">
            <div class="form-group has-feedback">
                <input id="email_id" name="email_id" type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            <div class="row">
                <div class="col-xs-8"><p id="message"class='login-box-msg' style='color:red;'></p></div>
                <!--<div class="col-xs-8" id="message" class='login-box-msg'></div> -->
                <div class="col-xs-4">
                <button id="submit" type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:black;">Sign In</button>
                </div>
            </div>
            </form>
            <a href=<?php echo $sys_link."/forgot_password.php"; ?>>Reset Password</a> |  
            <a href=<?php echo $sys_link."/employee_signup.php"; ?>>Signup</a>
        </div>    
        </div>
        <center><img id="unlock" src="build/img/unlock.gif"></center>
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

    function showdiv() {
        var x = document.getElementById("unlock");
        x.style.display = "block";
    }
    function messerror(x){
        $('#message').fadeIn().html(x);
        setTimeout(function() {
        $('#message').fadeOut("fast");
        }, 5000 );
    }
    $(document).ready(function(){
        $("#login_form").on('submit', function(e){
            e.preventDefault();
            var email=$('#email_id').val();
            var password=$('#password').val();
            if(email=='' && password=='')
                messerror("Enter Email and Password");
            else if(email=='')
                messerror("Enter Email");
            else if(password=='')
                messerror("Enter Password");
            /*else if(email=='admin@visitor.com' && password=='admin@123'){
                $('#hj').hide();
                showdiv();
                setTimeout(function() {
                    window.location.href='http://visitor.infinityfreeapp.com/dash.php?id=admin@123';
                }, 1300);    
            }*/        
            else{
                $("#submit").prop('disabled', true);
                $.ajax({
                type: 'POST',
                url: 'gears/gear_login.php',
                data: $(this).serialize(),
                error:function(){
                    messerror("Something went wrong");
                },
                success: function(response){
                    if(response==9){
                        $('#hj').hide();
                        showdiv();
                        setTimeout(function() {
                        window.location.href='<?php echo $sys_link ?>/dash.php';
                        }, 1300);    
                    }
                    else if(response==1){
                        $('#hj').hide();
                        showdiv();
                        setTimeout(function() {
                        window.location.href='<?php echo $sys_link ?>/profile.php';
                        }, 1300);                        
                    }
                    else if(response==10){
                        $('#message').fadeIn().html("<p style='color: green;'>Please check your email for OTP</p>");
                        setTimeout(function() {
                        $('#message').fadeOut("fast");
                        setTimeout(function() {
                        $('#hj').hide();
                        showdiv();
                        }, 500);
                        }, 2000);               
                        setTimeout(function() {
                            window.location.href='<?php echo $sys_link ?>/verify.php';
                        }, 3500);
                    }
                    else if(response==2)
                        messerror("Password is incorrect");
                    else if(response==3)
                        messerror("No Email id found")     
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
        $('#password').focusout(function () {
            check_password();
        });
        function check_email() {
            var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if($('#email_id').val().length !=0){
                if (!(pattern.test($('#email_id').val().toLowerCase())))
                    messerror("Invalid email id");
            }
        }
        function check_password() {
            var password_length = $('#password').val().length;
            if (password_length < 8 && password_length !=0)
                messerror("Password is incorrect");
        }
    });
</script>
</body>
</html>

<?php 
include "cores/inc/config.php";
session_start();
// Check if the user is already logged in, if yes then redirect him to profile page
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
  <title><?php echo $sys_name; ?> | Sign up</title>
  <?php include "cores/inc/header.php"?>
  <style>
  #cor{
      margin-top: 50px;
      display:none;
  }
  </style>
</head>
<body class="hold-transition login-page" onload="myFunction()" style="background-image: url('build/img/bac4.jpg');background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
    <div class="login-box">
        <div id="hj">
        <div class="login-box-body">
            <center><img src="build/img/logo.jpg" width="150px"></center>
            <form method="post" id="signup_form">
            <div class="row">
                <div class="col-xs-6">
                    <input name="date" type="text" id="date" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date("Y/m/d"); ?>" required hidden>
                    <input name="time" type="text" id="time" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date("h:i:sa"); ?>" required hidden>                    
                    <div class="form-group">
                        <select class="form-control select2" id="salutation" name="salutation" > 
                        <option value="" selected disabled>Salutation</option>  
                        <option value="Mr">Mr</option>
                        <option value="Mrs">Mrs</option>
                        <option value="Miss">Miss</option>
                        </select>
                    </div>   
                </div>     
                <div class="col-xs-6">
                    <div class="form-group has-feedback">
                        <input id="fname" name="fname" type="text" class="form-control" placeholder="First Name" >
                        <span class="glyphicon  glyphicon-user form-control-feedback"></span>
                    </div>
                </div>
            </div>
            <div class="form-group has-feedback">
                <input id="lname" name="lname" type="text" class="form-control" placeholder="Last Name">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input id="email_id" name="email_id" type="email" class="form-control" placeholder="Email">
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            </div>
            <div class="row">
            <div class="col-xs-12">
            <div class="form-group">
                <select class="form-control select2"  data-placeholder="Department" id="department" name="department" tab-index="-1">
                  <option value="" selected disabled>Select Department</option>             
                    <?php
                    $sql="SELECT * FROM `employee_dept_tbl`";
                    if ($result = mysqli_query($link,$sql)) {
                        while ($row = mysqli_fetch_row($result)) {
                        echo '<option value='.$row[0].'>'. $row[1] .'</option>';
                        }}
                    ?>                        
                </select>
            </div>
            </div>
            </div>
            <div class="form-group has-feedback">
                    <div class="input-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                    <span id="code" class="input-group-addon">+91</span>                     
                    <input type="text" placeholder="Contact No" name="phone" id="phone"  maxlength="10" minlength="10" class="form-control" pattern="[0-9]+"onkeydown=" return(event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46))">
                    <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                    </div>
            </div>
            <div class="row">
            <div class="col-xs-6">
            <div class="form-group has-feedback">
                <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>
            </div>
            <div class="col-xs-6">
            <div class="form-group has-feedback">
                <input id="confirm_password" name="confirm_password" type="password" class="form-control" placeholder="Confirm Password">
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            </div>  
            </div>
            </div>  
            <div class="row">
                <div class="col-xs-8"><p id="message"class='login-box-msg' style='color:red;'></p></div>
                <div class="col-xs-4">
                <button id="submit" type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:black;">Sign up</button>
                </div>
            </div>
            </form> 
            <a href="<?php echo $sys_link; ?>/login.php">Already Registered</a>
        </div>  
        </div>
        <center><img id="cor" src="build/img/cor.gif"></center>  
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
        var a=false,b=false;
        function messerror(x){
            $('#message').fadeIn().html(x);
            setTimeout(function() {
            $('#message').fadeOut("fast");
            }, 5000 );
        }
        function showdiv() {
        var x = document.getElementById("cor");
        x.style.display = "block";
        }
        $("#signup_form").on('submit', function(e){
            e.preventDefault();
            var salutation=$('#salutation').val();
            var fname=$('#fname').val().trim();
            var lname=$('#lname').val().trim();
            var email=$('#email_id').val().trim();
            var department=$('#department').val();
            var phone=$('#phone').val();
            var password=$('#password').val();
            var confirm_password=$('#confirm_password').val();
            if(salutation==null)
                messerror("Select Salutation");
            else if(fname=='')
                messerror("Enter First Name");
            else if(lname=='')
                messerror("Enter last Name");
            else if(email=='')
                messerror("Enter Email");
            else if(department==null)
                messerror("Select Department");
            else if(phone=='')
                messerror("Enter Phone No");
            else if(password=='')
                messerror("Enter Password");
            else if(confirm_password=='')
                messerror("Enter confirm Password");
            else if(!a)
                check_password($('#confirm_password').val(),$('#password').val());
            else if(!b)
                check_email();       
            else{
                $("#submit").prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: 'gears/gear_signup.php',
                    data: $(this).serialize(),
                    error:function(){
                        messerror("Something went wrong");
                    },
                    success: function(response){
                        if(response==1){
                            $('.login-logo').hide();
                            $('#hj').hide();
                            showdiv();
                            setTimeout(function() {
                            window.location.href='<?php echo $sys_link ?>/login.php';
                            }, 1300);
                            }
                        else
                            messerror("Something went wrong");  
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
            check_password($(this).val(),$('#confirm_password').val());
        });
        $('#confirm_password').focusout(function () {
            check_password($(this).val(),$('#password').val());
        });
        function check_email() {
            var pattern = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if($('#email_id').val().length !=0){
                if (!(pattern.test($('#email_id').val().toLowerCase()))){
                    messerror("Invalid email id");
                } 
                else{
                    $.ajax({
                        type: 'POST',
                        url: 'gears/gear_checkemail.php',
                        data: {email_id :$('#email_id').val()},
                        error:function(){
                            messerror("Something went wrong");
                        },
                        success: function(response){
                            if(response==1)
                                b=true;
                            else
                                messerror("This email id is already taken");     
                        }
                    });
                }   
            }
        }
        function check_password(x,y) {
            if( x.length < 8 && x.length != 0 ){
                messerror("Password must be at least 8 characters");  
                a=false;
            }
            else if(y.length !=0 && (x!=y) ) {
                messerror("Password does not match");
                a=false;
            }
            else
                a=true;          
        }
    });
</script>

</body>
</html>

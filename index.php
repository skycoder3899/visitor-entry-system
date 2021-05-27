<?php 
    include "cores/inc/config.php";
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sys_name; ?> | Register</title>
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
        <!-- <div class="login-logo">
            <a href=<?php echo $sys_link; ?>><b>VISITOR</b></a>
        </div>-->
        <div id="hj">
        <div class="login-box-body">
            <center><img src="build/img/logo.jpg" width="150px"></center>
            <!-- <p class="login-box-msg">Registration</p> -->
            <form method="post" id="signup_form">
            <div class="row">
                <div class="col-xs-6">
                    <input name="date" type="text" id="date" value="<?php date_default_timezone_set("Asia/Calcutta"); echo date("Y/m/d"); ?>" required hidden>               
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
            <div class="form-group has-feedback">
                <select class="form-control select2"  data-placeholder="Host Department" id="host_department_id" name="host_department_id" tab-index="-1"                                                  onchange="showUser(this.value)">
                  <option value="" selected disabled>Select Host Department</option>  
                    <?php
                    $sql="SELECT * FROM `employee_dept_tbl`";
                    if ($result = mysqli_query($link,$sql)) {
                        while ($row = mysqli_fetch_row($result)) {
                        echo '<option value='.$row[0].'>'. $row[1] .'</option>';
                        }}
                    ?>                      
                </select>
            </div>
            <div class="form-group has-feedback">
                <select class="form-control select2"  id="host_id" data-placeholder="Host Name" name="host_id" data-show-subtext="true" data-live-search="true" tab-index="-1">
                    <option value="" selected disabled>Select Host Name</option>
                </select>
            </div>
            <div class="form-group has-feedback">
            <textarea class="form-control" rows="2" placeholder="State your purpose here" id="purpose" name="purpose" required=""></textarea>
            </div>    
            <div class="form-group has-feedback">
                    <div class="input-group <?php echo (!empty($phone_err)) ? 'has-error' : ''; ?>">
                    <span id="code" class="input-group-addon">+91</span>                      
                    <input type="text" placeholder="Contact No" name="phone" id="phone"  maxlength="10" minlength="10" class="form-control" pattern="[0-9]+"onkeydown=" return(event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46))">
                    <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
                    </div>
            </div>
            <div class="row">
                <div class="col-xs-8"><p id="message"class='login-box-msg' style='color:red;'></p></div>
                <div class="col-xs-4">
                <button id="submit" type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:black;">Register</button>
                </div>
            </div>
            </form> 
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
    function showUser(str) {
        if(str == "") {
            document.getElementById("host_department_id").innerHTML = "";
            return;
        }
        var xmlhttp2= new XMLHttpRequest();
        xmlhttp2.open("GET","gears/gethost.php?host_department_id="+document.getElementById("host_department_id").value,false);
        xmlhttp2.send(null);
        document.getElementById("host_id").innerHTML =xmlhttp2.responseText; 
    }
    $(document).ready(function(){
        var a=false,b=false,c=false;
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
            var host_department_id=$('#host_department_id').val();
            var host_id=$('#host_id').val();
            var purpose=$('#purpose').val();
            var phone=$('#phone').val();
            if(salutation==null)
                messerror("Select Salutation");
            else if(fname=='')
                messerror("Enter First Name");
            else if(lname=='')
                messerror("Enter last Name");
            else if(email=='')
                messerror("Enter Email");
            else if(host_department_id==null)
                messerror("Select Host Department");
            else if(host_id==null)
                messerror("Select Host Name");
            else if(phone=='')
                messerror("Enter Phone No");
            else{
                $("#submit").prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: 'gears/gear_register.php',
                    data: $(this).serialize(),
                    error:function(){
                        messerror("Something went wrong");
                    },
                    success: function(response){
                        if(response=='ok'){
                            $('#hj').hide();
                            showdiv();
                            setTimeout(function() {
                            window.location.href='http://visitor.infinityfreeapp.com';
                            }, 1300);
                        }
                        else if(response=='Errormail'){
                            messerror("Something went wrong with the mail system");
                        }
                        else
                            messerror(response);        
                    },
                    complete: function(){
                        $("#submit").prop('disabled', false);
                    }
                });
            }            
        });
    });
</script>

</body>
</html>

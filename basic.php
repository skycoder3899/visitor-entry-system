<?php 
include "cores/inc/config.php";  
session_start();
if(!isset($_SESSION["$sys_session"]) || $_SESSION["$sys_session"] !== true){
        header("location: ".$sys_link."/login.php");
        exit;
}
if($_SESSION["email_status"] != 'done'){
    header("location: ".$sys_link."/verify.php");
    exit;
}
if($_SESSION["email_status"] == 'done' && $_SESSION["basic_status"] == 'done'){
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
.it .btn-orange
{
	background-color: blue;
	border-color: #777!important;
	color: #777;
	text-align: left;
  width:100%;
}
.it input.form-control
{
	
	border:none;
  margin-bottom:0px;
	border-radius: 0px;
	border-bottom: 1px solid #ddd;
	box-shadow: none;
}
.it .form-control:focus
{
	border-color: #ff4d0d;
	box-shadow: none;
	outline: none;
}
.fileUpload {
    position: relative;
    overflow: hidden;
}
.fileUpload input.upload {
    position: absolute;
    top: 0;
    right: 0;
    margin: 0;
    padding: 0;
    font-size: 20px;
    cursor: pointer;
    opacity: 0;
    filter: alpha(opacity=0);
}
  </style>

</head>
<body class="hold-transition login-page" onload="myFunction()" style="background-image: url('build/img/bac4.jpg');background-repeat: no-repeat; background-attachment: fixed; background-size: cover;">
<div id="loader"></div>
<div style="display:none;" id="myDiv" class="animate-bottom">
    <div class="login-box">
        <div class="login-logo">
            <a href=<?php echo $sys_link; ?>><b>EMPLOYEE</b></a>
        </div>
        <div id="hj">
        <div class="login-box-body">
            <p class="login-box-msg">Basic details</p>
            <form method="post" id="basic_form">
            <div class="row">
                <div class="col-xs-6">                   
                    <div class="form-group">
                       <select class="form-control select2" id="employee_title" name="employee_title" > 
                        <option value="" selected disabled>Employee Title</option>  
                        <option value="Entry-Level">Entry-Level</option>
                        <option value="Individual Contributor">Individual Contributor</option>
                        <option value="Manager">Manager</option>
                        </select> 
                    </div>   
                </div>     
                <div class="col-xs-6">
                    <div class="form-group">
                        <select class="form-control select2" id="employee_type" name="employee_type" > 
                        <option value="" selected disabled>Working Type</option>  
                        <option value="Full Time">Full Time</option>
                        <option value="Part Time">Part Time</option>
                        </select>
                    </div>   
                </div>
            </div>
            
            <div class="form-group has-feedback">
                <div class="input-group date">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input type="text" class="form-control pull-right" id="datepicker" name="dataOfBirth" placeholder="Date of brith">
                </div>
            </div>
            <div class="row">
            <div class="col-xs-6">
            <div class="form-group has-feedback">
                <input class="form-control" placeholder="PIN Code" id="pincode" name="pincode"type="text" >
            </div>
            </div>
            <div class="col-xs-6">
            <div class="form-group has-feedback">
                <input class="form-control" placeholder="Country" id="Country" name="Country" type="text" >
            </div>  
            </div>
            </div>
            <div class="row">
            <div class="col-xs-6">
            <div class="form-group has-feedback">
                <input class="form-control" placeholder="State" id="State" name="State" type="text" >
            </div>
            </div>
            <div class="col-xs-6">
            <div class="form-group has-feedback">
                <input class="form-control" placeholder="city" id="city" name="city" type="text" >
            </div>  
            </div>
            </div>
            <div class="form-group has-feedback">
                <textarea class="form-control" id='Address' name="Address" rows="3" placeholder="Home Address"></textarea>
            </div>
            <div class="row">
                <div class="col-xs-8"><p id="message"class='login-box-msg' style='color:red;'></p></div>
                <div class="col-xs-4">
                <button id="next1" type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:black;">Next</button>
                </div>
            </div>
            </form>
            <form method="post" id="basic_form2">
                <div class="row">
                    <div class="col-xs-12">                   
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Upload your Profile Photo" readonly>
                                <div class="input-group-btn">
                                    <span class="fileUpload btn btn-success">
                                        <span class="upl" id="upload">Upload photo</span>
                                        <input type="file" class="upload up" id="file1" name="file1" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>    
                <div class="col-xs-12">                   
                    <div class="form-group">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Upload your Document ID" readonly>
                            <div class="input-group-btn">
                                <span class="fileUpload btn btn-success">
                                <span class="upl" id="upload">Upload file</span>
                                <input type="file" class="upload up" id="file2" name="file2" />
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <p id="message2"class='login-box-msg' style='color:red;'></p>
                <div class="row">
                    <div class="col-xs-2"></div>
                    <div class="col-xs-4">
                        <button id="back1" type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:black;">Back</button>
                    </div>
                    <div class="col-xs-4">
                        <button id="fsubmit" type="submit" class="btn btn-primary btn-block btn-flat" style="background-color:black;">Submit</button>
                    </div>
                </div>    
            </form>            
        </div>  
        </div>
    </div>
</div>

<?php 
include "cores/inc/footer.php";  
?>
<!-- bootstrap datepicker -->
<script src="<?php echo $sys_link ?>/assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
    var myVar;
    function myFunction() {
    myVar = setTimeout(showPage, 1);
    }

    function showPage() {
    document.getElementById("loader").style.display = "none";
    document.getElementById("myDiv").style.display = "block";
    }

    $('#datepicker').datepicker({
        autoclose: true
    });

    $(document).on('change','.up', function(){
                var names = [];
                var length = $(this).get(0).files.length;
                    for (var i = 0; i < $(this).get(0).files.length; ++i) {
                        names.push($(this).get(0).files[i].name);
                    }
                    // $("input[name=file]").val(names);
                    if(length>2){
                    var fileName = names.join(', ');
                    $(this).closest('.form-group').find('.form-control').attr("value",length+" files selected");
                    }
                    else{
                        $(this).closest('.form-group').find('.form-control').attr("value",names);
                    }
        });

    
    
    $(document).ready(function(){
        $('#basic_form2').hide();
        var a=false;
        function messerror(x){
            $('#message').fadeIn().html(x);
            setTimeout(function() {
            $('#message').fadeOut("fast");
            }, 5000 );
        }
        function messerrorup(x){
            $('#message2').fadeIn().html(x);
            setTimeout(function() {
            $('#message2').fadeOut("fast");
            }, 5000 );
        }
        $('#pincode').focusout(function () {
                $.ajax({
                    type: 'POST',
                    url: 'gears/get_pin.php',
                    data:{ pin : $(this).val() } ,
                    dataType: 'JSON',
                    error:function(){
                        messerror("Something went wrong");
                    },
                    success: function(response){
                        $('#city').val(response[0].city);
                        $('#city').css('color', 'black');
                        $('#Country').val(response[0].Country);
                        $('#Country').css('color', 'black');
                        $('#State').val(response[0].State);
                        $('#State').css('color', 'black');
                    }
                });
            });

        $("#basic_form").on('submit', function(e){
            e.preventDefault(); 
            var employee_type=$('#employee_type').val();
            var employee_title=$('#employee_title').val();
            var dob=$('#datepicker').val().trim();
            var pin=$('#pincode').val().trim();
            var adde=$('#Address').val().trim();
            if(employee_title==null)
                messerror('Select Employee Title')
            else if(employee_type==null)
                messerror('Select Work Type');
            else if(dob=='')
                messerror('Enter Date Of Birth');
            else if(pin=='')
                messerror('Enter PIN Code');
            else if(adde=='')
                messerror('Enter Address');            
            else{
                $(this).hide();
                $("#basic_form2").show();
            }      
        });
        $('#back1').on('click',function(e){
            e.preventDefault();
            $("#basic_form2").hide();
            $("#basic_form").show();
        })
        $('#fsubmit').on('click',function(e){
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'gears/gear_basic.php',
                data:  $('#basic_form').serialize(),
                error:function(){
                    message2("something went wrong try again later");
                },
                success: function(response){
                    if(response==1){
                        var form_data = new FormData(document.getElementById("basic_form2"));
                                $.ajax({
                                    type: 'POST',
                                    url: 'gears/gear_setdoc.php',
                                    data: form_data,
                                    contentType : false,
                                    processData : false,
                                    error:function(){
                                        message2("something went wrong try again later");
                                    },
                                    success: function(response){
                                        if(response==1)
                                            window.location.replace("http://visitor.infinityfreeapp.com/profile.php");
                                        else
                                            alert(response);    
                                    }
                            });
                    }
                    else
                        message2("something went wrong try again later");
                }
        });
            
        })
    });
</script>

</body>
</html>

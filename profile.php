<?php include "cores/inc/config.php";
session_start();
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["$sys_session"]) || $_SESSION["$sys_session"] !== true){
    header("location: ".$sys_link."/login.php");
    exit;
}
if($_SESSION["email_status"] != 'done'){
    header("location: ".$sys_link."/verify.php");
    exit;
}
if($_SESSION["basic_status"] != 'done'){
    header("location: ".$sys_link."/basic.php");
    exit;
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sys_name ?> | Profile</title>
  <?php include "cores/inc/header.php"?>
</head>

<body class="hold-transition skin-blue layout-top-nav">
  <div class="wrapper">
  <header class="main-header">
    <nav class="navbar navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <a href="#" class="navbar-brand"><b>VIZHOST</b></a>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
            <i class="fa fa-bars"></i>
          </button>
        </div>
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
             <li class="dropdown user user-menu">
              <!-- Menu Toggle Button --->
              <a href="#">
                <!-- The user image in the navbar-->
              <?php
                if(isset($_SESSION["e_id"])){
    	            $profile_qry="SELECT * FROM employee_tbl E INNER JOIN employee_basic_tbl EB ON E.e_id=EB.e_id INNER JOIN employee_dept_tbl ED ON E.department_id=ED.department_id WHERE E.e_id='".$_SESSION['e_id']."'";
	                $profile_result=mysqli_query($link,$profile_qry);
	                $profile_details=mysqli_fetch_assoc($profile_result);
                     echo "<img src='build/img/prof/".$profile_details['photo_link']."' class='user-image'>";
                     echo "<span class='hidden-xs'>".$profile_details['f_name']." ".$profile_details['l_name']."</span>";
                }
              ?>
              </a>
            </li>
            <li class="dropdown tasks-menu">
              <!-- Menu Toggle Button -->
              <a href="logout.php" title="Logout" class="" data-toggle="">
                <i class="fa fa-sign-out"></i>
              </a>
            </li>
          </ul>
        </div>
        <!-- /.navbar-custom-menu -->
      </div>
      <!-- /.container-fluid -->
    </nav>
  </header> 
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Employee Profile
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Employee profile</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="build/img/prof/<?php echo $profile_details['photo_link']; ?>" alt="profile picture">

              <h3 class="profile-username text-center"><?php echo $profile_details['f_name']." ".$profile_details['l_name']; ?></h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Working position</b> <a class="pull-right"><?php echo $profile_details['employee_title']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Working type</b> <a class="pull-right"><?php echo $profile_details['working_type']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Department</b> <a class="pull-right"><?php echo $profile_details['type']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Email id</b> <a class="pull-right"><?php echo $profile_details['email_id']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right"><?php echo $profile_details['phone']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Date of Birth</b> <a class="pull-right"><?php echo $profile_details['dob']; ?></a>
                </li>
                <li class="list-group-item">
                  <b>Address</b><br> <a><?php echo $profile_details['address']; ?></a>
                </li>
              </ul>
              <button href="#" id="set_status" class="btn btn-primary btn-block"><b><?php if($profile_details['e_stats']=='available') echo 'Available'; else echo 'Unavailable';?></b></button>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class=""><a>Visitors Details</a></li>
            </ul>
            <div class="tab-content">
              <div class="active tab-pane" id="profile">
            <div class="box-body" id="live_data">
              
            </div>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  </div>
 <?php include 'cores/inc/footer.php'?>
<script>
$(document).ready( function () {
      function fetch_data()  
      {  
           $.ajax({  
                url:"gears/gear_emp_visitor.php",  
                method:"POST",  
                success:function(data){  
                     $('#live_data').html(data);  
                }  
           });  
      }  
      fetch_data();  
  });
</script>  
<script>
$(document).ready(function(){
  $("#set_status").click(function(){
                $("#set_status").prop('disabled', true);
                $.ajax({
                type: 'POST',
                url: 'gears/gear_set_status.php',
                data: { e_id: <?php echo $_SESSION["e_id"]; ?> },
                success: function(response){
                        $("#set_status").html(response);
                },
                complete: function(){
                    $("#set_status").prop('disabled', false);
                }
            });
  });
});
</script>
</body>

</html>
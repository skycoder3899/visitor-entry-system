<?php 
session_start();
// Check if the admin is logged in, if not then redirect him to login page
if($_SESSION["admin_id"] != 'done'){
    header("location: ".$sys_link."/login.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>VIZHOST | Dashboard </title>
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
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
             <li class="dropdown user user-menu">
              <!-- Menu Toggle Button --->
              <a href="#">
                <!-- The user image in the navbar-->
                     <img src='build/img/1.png' class='user-image'>
                     <span class='hidden-xs'>ADMIN</span>                  
              </a>
            </li>
            <li class="dropdown tasks-menu">
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

        <section class="content-header">
            <h1>
            Dashboard
            </h1>
        </section>

        <section class="content">
            <div class="row">
        <div class="col-md-3">
          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="build/img/4.jpg" alt="profile picture">

              <h3 class="profile-username text-center">Admin_name</h3>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Working position</b> <a class="pull-right">Administrator</a>
                </li>
                <li class="list-group-item">
                  <b>Working type</b> <a class="pull-right">Full Time</a>
                </li>
                <li class="list-group-item">
                  <b>Department</b> <a class="pull-right">Administration</a>
                </li>
                <li class="list-group-item">
                  <b>Email id</b> <a class="pull-right">admin@visitor.com</a>
                </li>
                <li class="list-group-item">
                  <b>Phone</b> <a class="pull-right">8017448318</a>
                </li>
              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
                <div class="col-md-9">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                        <li class="active"><a href="#employees_tbl" data-toggle="tab" aria-expanded="true">Employees Table</a></li>
                        <li class=""><a href="#visitors_tbl" data-toggle="tab" aria-expanded="false">Visitors Table</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="employees_tbl">
                                <div class="box-body" id="live_data">

                                </div>
                            </div>
                            <div class="tab-pane" id="visitors_tbl">
                                <div class="box-body" id="live_data2">
                                
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content -->
                    </div>
                <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </section>

    </div>
  </div>
 <?php include 'cores/inc/footer.php'?>
    
<script>
    $(document).ready( function () {
        function fetch_data()  
        {  
            $.ajax({  
                    url:"gears/select_emp_tbl.php",  
                    method:"POST",  
                    success:function(data){  
                        $('#live_data').html(data);  
                    }  
            });  
        }  
        fetch_data();  
    });

    $(document).ready( function () {
        function fetch_data2()  
        {  
            $.ajax({  
                    url:"gears/gear_visitor.php",  
                    method:"POST",  
                    success:function(data){  
                        $('#live_data2').html(data);  
                    }  
            });  
        }  
        fetch_data2();  
    });
</script>  
</body>

</html>
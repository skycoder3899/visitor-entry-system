<?php include "cores/inc/config.php";
    date_default_timezone_set('Asia/Kolkata');
    if(isset($_GET['v_id'])){
        $v_id =$_GET['v_id'];
        $time= date("h:i:sa");
        $sql = "UPDATE `visitor_tbl` SET `check_out_time`='$time' WHERE v_id=$v_id";
        if(mysqli_query($link, $sql)){
            if(mysqli_affected_rows($link)>0){
                header( "Location:thanks.php");
                exit;
            }
        }
    }
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $sys_name ?> | Thank You</title>
  <?php include "cores/inc/header.php"?>
    <style>
@media screen and (min-width: 768px)
.jumbotron {
    padding-top: 48px;
}
.jumbotron {
    padding-top: 70px;
    margin-bottom: 0px;
    color: inherit;
    background-color: #87CEEB;
}
</style>
</head>

<body style="background-color: #87CEEB;">
  <!-- Full Width Column -->
    <div class="jumbotron text-center">
    <h1 class="display-3">Thank You for visiting!</h1>
    <p class="lead"><strong>We hope you completed your purpose for visiting us.</strong> </p>

    <p class="lead">
    <a class="btn btn-primary btn-sm" href="<?php echo $sys_link ?>" role="button">Continue to Registry page</a>
    </p>
    </div>
 <?php include 'cores/inc/footer.php'?>
</body>

</html>
<?php
require_once "data.php";
session_start();
if(isset($_POST['in_time'])&&isset($_POST['purpose']) &&isset($_POST['host'])){
  $sql="INSERT INTO employ.entery(`vname`, `vgender`, `vphone`, `vemail`, `cat`, `intime`, `vpurpose`, `host`) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
  $statement=$p->prepare($sql);
  if($statement->execute(['a'=>$_SESSION['vname'],'b'=>$_SESSION['vgender'],'c'=>$_SESSION['vphone'],'d'=>$_SESSION['vemail'],'e'=>$_SESSION['cat'],'f'=>$_POST['in_time'],'g'=>$_POST['purpose'],'h'=>$_POST['host']])){
    $stmt = $p->prepare("SELECT * FROM employ.employee WHERE cat= :x && name=:y");
    $stmt->execute(['x'=>$_SESSION['cat'],'y'=>$_POST['host']]);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    while($names = $stmt->fetch()){
        $number= "91";
        $no =$names->phone;
        $username = "xakasa4142@vmgmails.com";
        $hash = "9cd2989a79ed04dc8ed200addccdd806a6cbe45a53dd0d64c9e483a5e7e21597";
        $test = "0";
        $sender = "TXTLCL"; // This is who the message appears to be from.
        $numbers = $number.$no;
        $message = "http://localhost/project/sendback.php?number=".$_SESSION['vphone'];
        $message = urlencode($message);
        $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
        $ch = curl_init('http://api.textlocal.in/send/?');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch); // This is the result from the API
        curl_close($ch);
        echo $message;
        echo $result;
    }
    echo "<script>alert('data is INSERT Success')</script>"; 
  }else
  {
    echo "<script>alert('data is not INSERT')</script>";
  }
  unset($_SESSION["cat"]);
  unset($_SESSION["vname"]);
  unset($_SESSION["vgender"]);
  unset($_SESSION["vphone"]);
  unset($_SESSION["vemail"]);
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="jquery.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="entery.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
<div class="bg-image">
	<div class="navbar">
		<a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
		<a class="Login"  href="#"><i class="fa fa-fw fa-user"></i> Login</a>
	</div>
    <form  method="POST">
      <label for="in_time"><b>Check-in</b></label>
      <input type="time" placeholder="Check-in time" name="in_time"><br>
      <label for="purpose"><b>Purpose</b></label>
      <input type="text" placeholder="Purpose" name="purpose"><br>
      <label for="Host"><b>Host Name</b></label>
      <select name="host" >
         <option value='0' >Select Hostname</option>
         <?php
          session_start();
          require_once "data.php";
          if(isset( $_SESSION["cat"])){
           $stmt = $p->prepare("SELECT * FROM employ.employee WHERE cat= :x");         
           $stmt->execute([':x'=>$_SESSION["cat"]]);
            $stmt->setFetchMode(PDO::FETCH_OBJ);
            while($names = $stmt->fetch())
                  echo "<option value= $names->name>".$names->name."</option>";  
          }

          ?>
      </select>
      <button type="Submit" class="btn">Save</button>  
    </form>
</div>
</body>
</html> 

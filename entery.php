<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="jquery.js" type="text/javascript"></script>
<script src="jqueryUI/jquery-ui.js" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="entery.css">
<link rel="stylesheet" href="jqueryUI/jquery-ui.css">
<link rel="stylesheet" href="jqueryUI/jquery-ui.structure.css">
<link rel="stylesheet" href="jqueryUI/jquery-ui.theme.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php
session_start();
require_once "data.php";

if (($_SERVER["REQUEST_METHOD"] == "POST")) {
  $sql = "INSERT INTO employ.entery(`vname`, `vgender`, `vphone`, `vemail`, `cat`, `intime`, `vpurpose`, `host`) VALUES (:a,:b,:c,:d,:e,:f,:g,:h)";
  $statement = $p->prepare($sql);
  if ($statement->execute(['a' => $_POST['name'], 'b' => $_POST['gender'], 'c' => $_POST['phone'], 'd' => $_POST['email'], 'e' => $_POST['cat'], 'f' => $_POST['in_time'], 'g' => $_POST['purpose'], 'h' => $_POST['host']])) {
    $stmt = $p->prepare("SELECT * FROM employ.employee WHERE cat= :x && name=:y");
    $stmt->execute(['x' => $_POST['cat'], 'y' => $_POST['host']]);
    $stmt->setFetchMode(PDO::FETCH_OBJ);
    while ($names = $stmt->fetch()) {
      $number = "91";
      $no = $names->phone;
      $username = ""; //Enter your user name from SMS gateway 
      $hash = ""; //Enter your hash code provided from SMS gateway
      $test = "0";
      $sender = "TXTLCL"; // This is who the message appears to be from.
      $numbers = $number . $no;
      $message = "http://localhost/project/sendback.php?number=" . $_SESSION['vphone'];
      $message = urlencode($message);
      $data = "username=" . $username . "&hash=" . $hash . "&message=" . $message . "&sender=" . $sender . "&numbers=" . $numbers . "&test=" . $test;
      $ch = curl_init('http://api.textlocal.in/send/?');
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $result = curl_exec($ch); // This is the result from the API
      curl_close($ch);
      echo $message;
      echo $result;
    }
    echo "<script>alert('data is INSERTED')</script>";
  } else {
    echo "<script>alert('data is not INSERTED')</script>";
  }
}
?>

<body>
  <div class="bg-image">
    <div class="navbar">
      <a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
      <a class="Login" href="#"><i class="fa fa-fw fa-user"></i> Login</a>
    </div>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <label for="name"><b>Name</b></label>
      <input type="text" placeholder="Name" name="name"><br>
      <label for="gender"><b>Gender</b></label>
      <input type="radio" name="gender" value="male">Male
      <input type="radio" name="gender" value="female">Female<br>
      <label for="phone"><b>Phone No</b></label>
      <input type="tel" placeholder="phone No" name="phone"><br>
      <label for="email"><b>Email</b></label>
      <input type="text" placeholder="Email Id" name="email"><br>

      <label for="category "><b>Category</b></label>
      <select name="cat" id="cat" onchange="showUser(this.value)">
        <option value="">Select Category</option>
        <?php
        $sql = "SELECT * FROM employ.employee";
        $stmt = $p->prepare($sql);
        $stmt->execute();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo '<option value="' . $row['id'] . '">' . $row['cat'] . '</option>';
        }
        ?>
      </select><br>
      <label for="in_time"><b>Check-in</b></label>
      <input type="time" placeholder="Check-in time" name="in_time"><br>
      <label for="purpose"><b>Purpose</b></label>
      <input type="text" placeholder="Purpose" name="purpose"><br>
      <label for="Host"><b>Host Name</b></label>
      <select name="host" id="host">
        <option value="" selected disabled>Please select Host</option>
      </select>
      <button type="Submit" name="submit" class="btn">Save</button>
    </form>
  </div>
</body>
<script>
  function showUser(str) {
    if (str == "") {
      document.getElementById("cat").innerHTML = "";
      return;
    }
    var xmlhttp2 = new XMLHttpRequest();
    xmlhttp2.open("GET", "gethost.php?category=" + document.getElementById("cat").value, false);
    xmlhttp2.send(null);
    document.getElementById("host").innerHTML = xmlhttp2.responseText;
  }
</script>

</html>
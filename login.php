<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login</title>
<link rel="stylesheet" type="text/css" href="login.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script>
  function validateForm() {
    var x=document.forms["lo"]["Username"].value;
    var y=document.forms["lo"]["psw"].value;
    if(x=="admin"&&y=="admin"){
        return true;
    }
    else{
    alert("wrong username and password");
    return false;
    }
}
   
</script>
</head>
<body>

<div class="bg-image">
	<div class="navbar">
		<a class="active" href="#"><i class="fa fa-fw fa-home"></i> Home</a>
		<a class="Login" href="#"><i class="fa fa-fw fa-user"></i> Login</a>
	</div>
	<h1>Login</h1>
	<form class="container" name="lo" onsubmit="return validateForm()" action="Registration.php" method="post">
		<label ><b>Username</b></label>
		<input type="text" placeholder="Username" name="Username"><!--username is admin-->
		<label ><b>Password</b></label>
		<input type="password" placeholder="Password" name="psw"><!--Password is admin-->
		<button type="submit" class="btn">Login</button>
	</form>
</div>
</body>
</html>

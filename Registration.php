<?php
require_once "data.php";
if(isset($_POST['Category'])&&isset($_POST['emp_name']) &&isset($_POST['emp_phone'])&& isset($_POST['emp_email'])){
	$sql="INSERT INTO employ.employee (`cat`, `name`, `phone`, `email`) VALUES (:x,:y,:z,:v)";
	$statement=$p->prepare($sql);
	if($statement->execute(['x'=>$_POST['Category'],'y'=>$_POST['emp_name'],'z'=>$_POST['emp_phone'],'v'=>$_POST['emp_email']])){
		echo "<script>alert('data is INSERT Success')</script>"; 
	}else
	{
		echo "<script>alert('data is not INSERT')</script>";
	}
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Registration</title>
<link rel="stylesheet" type="text/css" href="Registration.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
<div class="bg-image">
	<div class="navbar">
		<a class="active" href="Registration.php"><i class="fa fa-envelope"></i> New Employee </a>
		<a class="Entry" href="#"><i class="fa fa-fw fa-user"></i> Logout</a>
		<a class="Entry" href="employeeList.php"><i class="fa fa-envelope"></i> Employee List </a>
		<a class="Entry"  href="entery.php"><i class="fa fa-globe"></i> Entry</a>
	</div>
	<h1>Login</h1>
	<div class="container">
		<form method="POST" >
		<label for="category "><b>Category</b></label>
		<select name="Category">
			<option >CEO</option>
			<option >HR</option>
			<option >MD</option>
			<option >CFO</option>
		</select>
		<label for="name"><b>Name</b></label>
		<input type="text" placeholder="Name" name="emp_name">
		<label for="psw"><b>Phone No</b></label>
		<input type="tel" placeholder="Number" name="emp_phone">
		<label for="email"><b>Email</b></label>
		<input type="text" placeholder="Email Id" name="emp_email">
		<button type="Submit" class="btn">Save</button>
			
		</form>
	</div>
</div>
</body>
</html> 

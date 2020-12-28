<?php
if(isset($_POST['logout'])){
    header('Location: login.php');
    return;
}
?>
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="employeeList.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body>
<form class="navbar" method="POST">
	<a class="active" href="#"><i class="fa fa-envelope"></i> Employee List </a>
	<button type="submit" class="Entry" name="logout"><i class="fa fa-fw fa-user"></i>Log out</button>
	<a class="Entry" href="Registration.php"><i class="fa fa-envelope"></i> New Employee </a>	
    <a class="Entry" href="entery.php"><i class="fa fa-globe"></i> Entry</a>
</form>
<h2>Employee Table</h2>
</body>
</html> 
<?php
require_once "data.php";
$print = ""; 
$stmt = $p->query("SELECT * FROM employ.employee"); 
$stmt->setFetchMode(PDO::FETCH_OBJ);

if($stmt->execute() <> 0)
{

    $print .= '<table border>';
    $print .= '<tr><th> Employee name </th>';
    $print .= '<th> Category </th>';
    $print .= '<th> Contact </th>';
    $print .= '<th> Email Id </th></tr>';



    while($names = $stmt->fetch())
    {

        $print .= '<tr>';
        $print .= "<td>{$names->name}</td>";
        $print .= "<td>{$names->cat}</td>";
        $print .= "<td>{$names->phone}</td>";
        $print .= "<td>{$names->email}</td>";
        $print .= '</tr>';
    }

    $print .= "</table>";
    echo $print;
}
?>

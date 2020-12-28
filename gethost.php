<?php
include "data.php";
$category= intval($_GET['category']);
$sql="SELECT * FROM employ.employee WHERE id=$category";
$stmt = $p->prepare($sql);
$stmt->execute();
$out;
$out.= "<select>";
while ( $row = $stmt->fetch(PDO::FETCH_ASSOC)) 
{
	 $out.= '<option value="'.$row['cid'].'">'.$row['name'].'</option>';
}
$out.= "</select>";
echo $out;

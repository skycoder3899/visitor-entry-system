<?php
try{
$p=new PDO('mysql:host=localhost;port:3306;dbname=employ','root','');
$p->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
	echo "Connection failed: " . $e->getMessage();
}
?>
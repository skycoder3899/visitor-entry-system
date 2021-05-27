<?php
//Database Variables
$db_host = "sql108.epizy.com";
$db_user = "epiz_28057742";
$db_pass = "lA7FzbbNI0hQgCz";
$db_name = "epiz_28057742_visitor";
$link = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
//System Variables
$sys_link = "http://visitor.infinityfreeapp.com";
$sys_name = "VIZHOST";
$sys_title = "VIZHOST";
$sys_session = "infinity";

?>
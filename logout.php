<?php
include "cores/inc/config.php";

// Initialize the session
session_start();

// for a single variable
unset($_SESSION['$sys_session']); 

// destroy the Session, not just the data stored!
session_destroy();

// delete the session contents, but keep the session_id and name:
session_unset();

// Redirect to login page
header("location: login.php");
exit;
?>
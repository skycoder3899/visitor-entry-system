<!DOCTYPE html>
<html>
<head>
<title>Zhong Shan Hui & Prateek Kesharwani</title>
<?php require_once "data.php"; ?>
</head>
<body>
<div class="container">
<h1>Please wait for a while. Your request is being processed.</h1>
<p>
</div>
</body>
</html>
<?php
if(isset($_GET['number']))
{
	$username = "xakasa4142@vmgmails.com";
    $hash = "9cd2989a79ed04dc8ed200addccdd806a6cbe45a53dd0d64c9e483a5e7e21597";
    $test = "0";
    $sender = "TXTLCL"; // This is who the message appears to be from
    $numbers = $_GET['number'];
    $message = "I am in a meeting right now. Please meet me after 10 mins.";
    $message = urlencode($message);
    $data = "username=".$username."&hash=".$hash."&message=".$message."&sender=".$sender."&numbers=".$numbers."&test=".$test;
    $ch = curl_init('http://api.textlocal.in/send/?');
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($ch); // This is the result from the API
    curl_close($ch);
    echo $result;
}

?>
<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
		die();
	}
    require_once('dbfunctions.php');
	$conn=db_connect();
	date_default_timezone_set('Europe/Bucharest');
    $date = date('d/m/Y h:i:s a', time());
    $apo=$_SESSION['user'];
    $se=$_SESSION['msgto'];
    $message=$_POST['chatmsg'];
	$sql="insert into chat (apo,se,message,time) values ('$apo','$se','$message','$date') ";
    if(!mysqli_query($conn,$sql)){
	    echo "could not send message due to error";
		die();
	}
	mysqli_close($conn);
?>
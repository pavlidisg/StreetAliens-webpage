<?php
	session_start();
	if(isset($_SESSION['user'])){
	    if(isset($_COOKIE['username'])){
	        setcookie("username", "", time() - 3600);
	    }
		session_unset();
		session_destroy();
		header("Refresh:1; url=index");
		die();
	}else{
		header("Refresh:2; url=index");
		echo "Unauthorized access<br>";
		die();
	}
?>
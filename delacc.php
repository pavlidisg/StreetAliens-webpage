<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
		die();
	}
	
    require_once('dbfunctions.php');
	$conn=db_connect();
	$cuser=$_SESSION['user'];
	$sql="select * from users where username='$cuser'";
	$result=mysqli_query($conn,$sql); 
	if(mysqli_num_rows($result)>0){
        $sql="delete from users where username='$cuser'";
        if(mysqli_query($conn,$sql)){ 
	        echo "Ο λογαριασμός σας διαγράφηκε οριστηκά!";
			session_unset();
		    session_destroy();
        }
	}else{
	    echo "Error occured!";
	}
?>
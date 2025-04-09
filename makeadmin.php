<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
		die();
	}
	
	if($_SESSION['role']!='admin'){
		header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!Permission denied!</b><br>redirect in 2s...";
		die();
	}
	
    require_once('dbfunctions.php');
	$conn=db_connect();
	$id=$_POST['idodu'];
	$sql="select * from users where id='$id'";
	$result=mysqli_query($conn,$sql); 
	if(mysqli_num_rows($result)>0){
        $sql="update users set role='admin' where id='$id'";
        if(mysqli_query($conn,$sql)){ 
	        echo "User with id: $id is now admin!";
        }
	}else{
	    echo "Error occured!";
	}
?>
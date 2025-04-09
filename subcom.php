<?php
	if(isset($_POST['subcom'])){
	    
		require_once('dbfunctions.php');
		$conn=db_connect();
		date_default_timezone_set('Europe/Bucharest');
        $date = date('d/m/Y h:i:s a', time());
        $comm=$_POST['comm'];
		if(!isset($_SESSION['user'])){
    		$name=$_POST['name'];
    		$email=$_POST['email'];
		}else{
		    $name=$_SESSION['user'];
		    $sql="select * from users where username='$name'";
		    $result=mysqli_query($conn,$sql);
		    if(mysqli_num_rows($result)>0){
			    $row=mysqli_fetch_assoc($result);
			    $email=$row['email'];
		    }
		}
		$sql="insert into comments (name,email,msg,timestamp) values ('$name','$email','$comm','$date')";
		if(!mysqli_query($conn,$sql)){
		    echo "could not post comment due to error";
		    die();
		}
	}else{
	        header("Refresh:2; url=index.php");
			echo "<b>Unauthorized access!</b><br>redirect in 2 sec.";
			die();
	}
?>
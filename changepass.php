<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
		die();
	}
	
    include 'navbar.php'; 
    
    if(isset($_POST['changepass'])){
        $errors = 0;
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
		require_once('dbfunctions.php');
		$conn=db_connect();
		$cnp=$_POST['cnpass'];
		$np=$_POST['npass'];
		$op=$_POST['opass'];
		$cuser=$_SESSION['user'];
		$sql="select * from users where username='$cuser'";
		$result=mysqli_query($conn,$sql);
	    if(mysqli_num_rows($result)>0){
	        $row=mysqli_fetch_assoc($result);
		    $pass=$row['password'];
		}
		if (empty($op)) { ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Συμπληρώστε τον τωρινό κωδικό πρόσβασης!</b>
			</div>
		<?php
		    $errors = 1;
        } else {
            $op = md5($op);
            $flag=0;
            if(strcmp($op,$pass)!=0){
                $flag=1;
            }
            if ($flag==1 ){ ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Λάθος στοιχεία!</b>
			</div>
		  <?php
		    $errors = 1;
            }
        }
        if (empty($np)) { ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Συμπληρώστε τον καινούριο κωδικό πρόσβασης!</b>
			</div>
		<?php
		    $errors = 1;
        } else {
            $np = test_input($np);
            if (!preg_match("/^[[:alnum:]]+$/",$np)){ ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Αυτός ο κωδικός πρόσβασης δεν επιτρέπεται!</b>
			</div>
		  <?php
		    $errors = 1;
            }
        }
        if(strcmp($np,$cnp)!=0){ ?>
            <div class="errmsg">
			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			<b>Ο νέος κωδικός πρόσβασης δεν ταιριάζει με την επιβεβαίωσή του!</b></b></div>
   <?php    $errors = 1;   
        }
		if($errors === 0){
		    $np=md5($np);
			$sql="update users set password='$np' where username='$cuser'";
			if(mysqli_query($conn,$sql)){ 
			    session_unset();
		        session_destroy();?>
			    <div style="padding: 15px; background-color: #008000; color: white;">
			        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			        <b>Το password άλλαξε επιτυχώς!</b></div>
            <?php
			}else{
				die();
			}		
		}
	}
    
    ?>

				

<!DOCTYPE html>
<html>
<head>
  <title>Street Aliens</title>
  <link rel="shortcut icon" type="image/x-icon" href="salogo.png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="bgnmore.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
.errmsg {
  padding: 15px;
  margin: 5px;
  background-color: #f44336;
  color: white;
}
</style>
</head>
<body>
    <form class="container" method="post">
        <h3>Change Password</h3>
	    <hr style="border-top: 1px solid green;">
        <label style="margin-top:15px;"><span class="error">* </span><b>Old password</b></label>
        <input type="password" placeholder="Enter old password" name="opass" required>
        
        <label><span class="error">* </span><b>New password</b></label>
        <input type="password" placeholder="Enter Password" name="npass"
        maxlength=20 pattern="(?=.*\d).{8,}" title="Must contain at least one number and at least 8 characters with no spaces. Maximum 20 characters"  
    	required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;" ><div id="message">
    	<p id="pswconf" class="invalid">Must contain: 8-20 characters , at least 1 number<br>Numbers and letters only!</p></div>
    	
    	<label><span class="error">* </span><b>Confirm new password</b></label>
        <input type="password" maxlength=16 placeholder="Confirm Password" name="cnpass" 
    	title="Passwords must match" required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;">
    	<br>
        
        <button class="btn" name="changepass" type="submit" >Change password</button>
    </form>
    
<?php
	include 'footer.php';
?>
    
</body>
</html>

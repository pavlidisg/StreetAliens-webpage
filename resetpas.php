<?php 
    if(!isset($_GET['rpform'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
        die();
    }
    
    if(isset($_POST['resetpassword'])){
        $errors = 0;
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
    	$un=$_POST['username'];
		$email=$_POST['email'];
        require_once('dbfunctions.php');
		$conn=db_connect();
		if (empty($un)) { ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Συμπληρώστε το όνομα χρήστη!</b>
			</div>
		<?php
		    $errors = 1;
        } else {
            $un = test_input($un);
            if (!preg_match("/^[[:alnum:]]+$/",$un)){ ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>To όνομα χρήστη δεν επιτρέπεται!</b>
			</div>
		  <?php
		    $errors = 1;
            }
        }
		if (empty($email)) { ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Συμπληρώστε το email!</b>
			</div>
		<?php
		    $errors = 1;
        } else {
            $email = test_input($email);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)){ ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>To email δεν είναι σωστό!</b>
			</div>
		  <?php
		    $errors = 1;
            }
        }
    	$sql="select * from users where username='$un' and email='$email'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==1){
		    $t=time();
		    $t2=md5(time());
		    $tun=md5($un);
		    $tem=md5($email);
		    $to=$email;
    		$subject='Street Aliens - Αλλαγή κωδικού πρόσβασης';
    		$message="Γεια $un,\r\nΑκολουθήστε τον παρακάτω σύνδεσμο για να επαναφέρετε τον κωδικό πρόσβασής σας:\r\nhttp://www.streetaliens.ga/resetpass.php?tun=$tun&tem=$tem&time=$t&$t2 \r\nΟ παραπάνω σύνδεσμος λήγει σε 3 μέρες.";
    		$headers = "From: StreetAliens0@gmail.com";
    		mail($to,$subject,$message,$headers);
    		$expt=$t+259200;
    		$sql="insert into rptokens (rptkn,expdate) values ('$tun','$expt')"; 
    		if(mysqli_query($conn,$sql)){
    		    
    		}else{
    		    echo "ERROR";
    		}?>
			 <div style="padding: 15px; background-color: #008000; color: white;">
			 <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			 <b>Σε λίγο θα σας σταλεί ένα email στον λογαριασμό σας με οδηγίες για την επαναφορά του κωδικού πρόσβασής σας.</b></div>
<?php   }else{?>
            <div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Δεν υπάρχει χρήστης με τα στοιχεία που δώσατε!</b>
			</div>
<?php	
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
  <link rel="stylesheet" href="pswvalidate.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
.errmsg {
  padding: 15px;
  margin: 5px;
  background-color: #f44336;
  color: white;
  text-align: center;
}
</style>
</head>
<body>
    <form class="container" method="post">
        <h3>Reset Password</h3>
	    <hr style="border-top: 1px solid green;">
        
        <label><span class="error">* </span><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="username">
    	
    	<label><span class="error">* </span><b>Email</b></label>
        <input type="email" placeholder="Enter email" name="email">
    	<br>
        
        <button class="btn" name="resetpassword" type="submit" >Reset password</button>
    </form>
    
<?php
	include 'footer.php';
?>

<script src="reg.js"></script>
    
</body>
</html>
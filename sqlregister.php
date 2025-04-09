<?php
    if(isset($_POST['register'])){
        $errors = 0;
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
		require_once('dbfunctions.php');
		$conn=db_connect();
		date_default_timezone_set('Europe/Bucharest');
        $date = date('d/m/Y h:i:s a', time());
		$un=$_POST['uname'];
		$email=$_POST['email'];
		$pass=$_POST['psw'];
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
        if (empty($pass)) { ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Συμπληρώστε τον κωδικό πρόσβασης!</b>
			</div>
		<?php
		    $errors = 1;
        } else {
            $pass = test_input($pass);
            if (!preg_match("/^[[:alnum:]]+$/",$pass)){ ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Αυτός ο κωδικός πρόσβασης δεν επιτρέπεται!</b>
			</div>
		  <?php
		    $errors = 1;
            }
        }
		$sql="select * from users where username='$un'";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)==1){ ?>
			<div class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Αυτό το όνομα χρήστη υπάρχει ήδη!<br>Παρακαλώ δοκιμάστε άλλο.</b></div>
		<?php	
		}else if($errors === 0){
		    $pass=md5($pass);
		    $t=time();
		    $t2=md5(time());
			$sql="insert into users (username,email,password,role,date)
			values ('$un','$email','$pass','user','$date')";
			$h_un=md5($un);
			$to=$email;
			$subject='Street Aliens - Επιβεβαίωση λογαριασμού';
			$message="Ακολουθήστε τον παρακάτω σύνδεσμο για να ενεργοποιήσετε τον λογαριασμό σας:\r\nhttp://www.streetaliens.ga/verifyacc.php?vun=$h_un&time=$t&$t2 \r\nΟ παραπάνω σύνδεσμος λήγει σε 3 μέρες";
			$headers = "From: StreetAliens0@gmail.com";
			mail($to,$subject,$message,$headers);
			if(mysqli_query($conn,$sql)){ ?>
			    <div style="padding: 15px; background-color: #008000; color: white;">
			        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			        <b>Επιτυχία εγγραφής!</b><br>Σε λίγο θα σας σταλεί ένα email στον λογαρασμό σας με τον σύνδεσμο επιβεβαίωσης.</b></div>
            <?php
			}else{
				die();
			}		
		}
	}else{
	    header("Refresh:2; url=register.php");
		echo "Unauthorized access!<br>";
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="bgnmore.css">
<style>
.errmsg {
  padding: 15px;
  margin: 5px;
  background-color: #f44336;
  color: white;
}
</style>
</head>
</html>
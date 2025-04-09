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
  text-align: center;
}
</style>
</head>
<body>
    <?php 
    if(isset($_GET['time']) && isset($_GET['tun']) && isset($_GET['tem'])){
        $t=$_GET['time'];
        $ct=time();
        $tun=$_GET['tun'];
        $tem=$_GET['tem'];
        require_once('dbfunctions.php');
        $conn=db_connect();
        $sql="select * from rptokens where rptkn='$tun' and valid='yes'";
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);
        if(mysqli_num_rows($result)<=0){?>
            <div class="errmsg">
    			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    		    <b>Αυτός ο σύνδεσμος δεν είναι έγκυρος!</b>
    		</div>
        <?php
            die();
        }else if($ct>$row['expdate']){?>
            <div class="errmsg">
    			<span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    		    <b>Αυτός ο σύνδεσμος έχει λήξει!</b>
    		</div>
        <?php 
            die();
        }else{
            if(isset($_POST['changepassword'])){
                include 'navbar.php'; 
                $errors = 0;
                $une=1;
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
        		require_once('dbfunctions.php');
        		$conn=db_connect();
        		$cnp=$_POST['cnpas'];
        		$np=$_POST['npas'];
        		$sql="select * from users";
        		$result=mysqli_query($conn,$sql);
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
        		if(mysqli_num_rows($result)>0){
            		while($row=mysqli_fetch_assoc($result)){ 
            	        $un=$row['username']; 
            	        $email=$row['email'];
            			if((strcmp(md5($un),$tun)==0) && (strcmp(md5($email),$tem)==0)){
            			    $une=0;
                			if($errors === 0){
                    		    $np=md5($np);
                    			$sql="update users set password='$np' where username='$un'";
                    			if(mysqli_query($conn,$sql)){ ?>
                    			    <div style="padding: 15px; background-color: #008000; color: white;">
                    			        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
                    			        <b>Το password άλλαξε επιτυχώς!</b></div>
                                <?php
                                        $sql="update rptokens set valid='no' where rptkn='$tun'";
                                        if(mysqli_query($conn,$sql)){
                                            die();
                                        }else{
                                            echo "ERROR";
                                        }
                    			}else{
                    				die();
                    			}		
                		    }
                		    break;
            			}
                    }	
            		if($une==1){?>
            		    <div class="errmsg">
        			        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        			        <b>Δεν υπάρχει χρήστης με αυτά τα στοιχεία!</b>
        			    </div>
        			<?php
            	    }
        		}else{?>
        		    <div class="errmsg">
        			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        			    <b>Δεν υπάρχουν χρήστες!</b>
        			</div>
        <?php   }
        	}
        }
    }else{
        die();
    }?>
    <form class="container" method="post">
        <h3>Change Password</h3>
	    <hr style="border-top: 1px solid green;">
        
        <label><span class="error">* </span><b>New password</b></label>
        <input type="password" placeholder="Enter new password" name="npas"
        maxlength=20 pattern="(?=.*\d).{8,}" title="Must contain at least one number and at least 8 characters with no spaces. Maximum 20 characters"  
    	required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;" ><div id="message">
    	<p id="pswconf" class="invalid">Must contain: 8-20 characters , at least 1 number<br>Numbers and letters only!</p></div>
    	
    	<label><span class="error">* </span><b>Confirm new password</b></label>
        <input type="password" maxlength=16 placeholder="Confirm new password" name="cnpas" 
    	title="Passwords must match" required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;">
    	<br>
        
        <button class="btn" name="changepassword" type="submit" >Change password</button>
    </form>
    
<?php
	include 'footer.php';
?>
    
</body>
</html>
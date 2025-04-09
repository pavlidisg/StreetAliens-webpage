<?php session_start();
	if(isset($_POST['login'])){
	    $errors=0;
		$un=$_POST['uname'];
		$pass=md5($_POST['psw']);
		require_once('dbfunctions.php');
		$conn=db_connect();
		if (empty($un)) { 
		    $errors = 1;
        } else {
            if (!preg_match("/^[[:alnum:]]+$/",$un)){ 
		        $errors = 1;
            }
        }
        if (empty($pass)) { 
		    $errors = 1;
        } else {
            if (!preg_match("/^[[:alnum:]]+$/",$pass)){ 
		        $errors = 1;
            }
        }   
		$sql="select * from users where username='$un' and password='$pass' ";
		$result=mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)>1){
		    header("Refresh:0; url=login.php");
			die();			
		}
		if(mysqli_num_rows($result)==1 && $errors===0 ){
		    $row=mysqli_fetch_assoc($result);
		    $vacc=$row['verify'];
		    if($vacc=='no'){?>
		        <div style="text-align: center;" class="errmsg">
    			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    			    <b>Ο λογαριασμός σας δεν είναι ενεργοποιημένος!</b>
			    </div>
    <?php   include 'loginform.php';
		    }else{
    		    header("Refresh:1; url=index");
    			$_SESSION['user']=$un;
    			if(!empty($_POST['remember'])){
    			    setcookie("username",$un,time() + (86400 * 30));
    			}
    			if($row['role']==='admin'){
    			    $_SESSION['role']='admin';
    			}else{
    			    $_SESSION['role']='user';
    			}
    			die();
    		 }
		}else{
		    include("navbar.php");?>
		    <div style="text-align: center;" class="errmsg">
			    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			    <b>Το όνομα χρήστη ή ο κωδικός πρόσβασης είναι λάθος!</b>
			</div>
	<?php
			include 'loginform.php';
		}
	}else{
	    if(!isset($_SESSION['user'])){
	        include("navbar.php");
	        include 'loginform.php';
	    }else{
	        header("Refresh:2; url=index");
	        echo "Είστε ήδη συνδεδεμένος.<br>Ανακατεύθυνση στην αρχική σελίδα!";
	        die();
	    }
	    
	}?>
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
  span.psw {
    float: right;
	text-decoration: underline;
  }
  
  .errmsg {
  padding: 15px;
  margin: 5px;
  background-color: #f44336;
  color: white;
}
</style>
</head>
<body>
<?php include("footer.php");?>
</body>
</html> 
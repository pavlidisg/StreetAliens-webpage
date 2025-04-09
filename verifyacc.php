<?php 
    if(isset($_GET['vun']) && isset($_GET['time'])){
        $t=$_GET['time'];
        $ct=time();
        if(($ct-$t)>259200){?>
    		    <div class="errmsg">
			        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
			        <b>Αυτός ο σύνδεσμος δεν είναι έγκυρος!</b>
			    </div>
			<?php
		    	die();
        }
        require_once('dbfunctions.php');
		$conn=db_connect();
        $hun=$_GET['vun'];
        $sql="select * from users";
        $result=mysqli_query($conn,$sql);
        if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){ 
			    $un=$row['username']; 
			    if(strcmp(md5($un),$hun)==0){
			        $v=$row['verify'];
			        if($v=='yes'){
			            echo "this acc is already verified";
			        }else{
			            $sql="update users set verify='yes' where username='$un'";
			            if(mysqli_query($conn,$sql)){
			                header("Refresh:2; url=login.php");
			                echo "<b>Ο λογαριασμός ενεργοποιήθηκε επιτυχώς!</b><br>Ανακατεύθυνση στην σελίδα login αε 2s.";
			            }
			        }
			        break;
			    }
			}
        }
    }else{
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
        die();
    }
?>
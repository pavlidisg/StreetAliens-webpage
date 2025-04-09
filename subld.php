<?php
    session_start();
    if(!isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
		die();
	}
    require_once('dbfunctions.php');
	$conn=db_connect();
    $ld=$_POST['lod'];
    $cid=$_POST['cid'];
    $cuser=$_SESSION['user'];
    $sql="select * from cld where uwl='$cuser' and c_id='$cid' ";
	$result=mysqli_query($conn,$sql);
	if(mysqli_num_rows($result)===1){
	    $row=mysqli_fetch_assoc($result);
        $cld=$row['lod'];
        if(!strcmp($cld,'like')){
            if(!strcmp($ld,'like')){
                $sql="update comments set likes=likes-1 where id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
    	        $sql="delete from cld where uwl='$cuser' and c_id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
            }else{
                $sql="update comments set dislikes=dislikes+1 where id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
    	        $sql="update cld set lod='dislike' where uwl='$cuser' and c_id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
    	        $sql="update comments set likes=likes-1 where id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
            }
        }else{
            if(!strcmp($ld,'dislike')){
                $sql="update comments set dislikes=dislikes-1 where id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
    	        $sql="delete from cld where uwl='$cuser' and c_id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
            }else{
                $sql="update comments set likes=likes+1 where id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
    	        $sql="update cld set lod='like' where uwl='$cuser' and c_id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
    	        $sql="update comments set dislikes=dislikes-1 where id='$cid'";
                if(!mysqli_query($conn,$sql)){
        	        echo "Error!";
        	        die();
    	        }
            }
        }
	}else if(!strcmp($ld,'like')){
        $sql="update comments set likes=likes+1 where id='$cid'";
        if(!mysqli_query($conn,$sql)){
	        echo "Error!";
	        die();
	    }
	    $sql="insert into cld (c_id,uwl,lod) values ('$cid','$cuser','$ld')";
        if(!mysqli_query($conn,$sql)){
	        echo "Error!";
	        die();
	    }

    }else if(!strcmp($ld,'dislike')){
        $sql="update comments set dislikes=dislikes+1 where id='$cid'";
        if(!mysqli_query($conn,$sql)){
	        echo "Error!";
	        die();
	    }
	    $sql="insert into cld (c_id,uwl,lod) values ('$cid','$cuser','$ld')";
        if(!mysqli_query($conn,$sql)){
	        echo "Error!";
	        die();
	    }
    }else{
        echo "Error!";
    }
	mysqli_close($conn);
?>
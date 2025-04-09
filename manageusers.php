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
	
    include 'navbar.php'; ?>
<table id="bmipinaks" class="container">
	    <tr>	
	        <th>ID</th>
			<th>Username</th>
			<th>Role</th>
			<th>Options</th>
		</tr>
	<?php 
	    require_once('dbfunctions.php');
	    $conn=db_connect();
	    $cuser=$_SESSION['user'];
	    $sql="select * from users";
	    $result=mysqli_query($conn,$sql); 
	    if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
			    $id=$row['id'];
				$un=$row['username'];
				$em=$row['email'];
				$role=$row['role']; ?>
				<tr>
				    <td><?php echo $id ?></td>
				    <td><?php echo $un ?></td>
				    <td><?php echo $role ?></td>
				    <td>
				        <?php if($un!='gpavlidis'){?>
				        <a class="dropdown-toggle" toggle="tab" style="color: #000000; cursor:pointer;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</a>
		                 <div class="dropdown-menu" style="background-color: #556B2F;">
		                     <?php if($role!='admin'){?>
			                <button value="<?php echo $id?>" class="dropdown-item deluser" style="cursor:pointer; color: red;" ><b>Delete  &#x274C</b></button>
			                <?php }
			                if($role==='user'){?>
			                <button value="<?php echo $id?>" class="dropdown-item makeadmin" style="cursor:pointer; color: red;" ><b>Make admin</b></button>
			                <?php }else{ ?>
			                <button value="<?php echo $id?>" class="dropdown-item makeuser" style="cursor:pointer; color: red;" ><b>Make user</b></button>
			                <?php } ?>
			            </div>  
			            <?php } ?>
			        </td>
				</tr>
<?php		}
	    }
	    mysqli_close($conn);
	?>
</table>

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

</style>
</head>
<script>
    $(document).on('click', '.deluser', function (event) {
        var id = $(this).val();
        console.log('id is:',id);
        if (confirm("Είστε σίγουρος/η ότι θέλετε να διαγράψετε οριστικά αυτόν τον λογαριασμό?")==true) {
            $.post("deluser.php",{idodu: id});
            event.preventDefault();
            location.reload();
            return true;
        } else {
            event.preventDefault();
        };
    });
    
    $(document).on('click', '.makeadmin', function (event) {
        var id = $(this).val();
        console.log('id is:',id);
        if (confirm("Είστε σίγουρος/η ότι θέλετε να κάνετε αυτόν τον χρήστη Admin?")==true) {
            $.post("makeadmin.php",{idodu: id});
            event.preventDefault();
            location.reload();
            return true;
        } else {
            event.preventDefault();
        };
    });
    
    $(document).on('click', '.makeuser', function (event) {
        var id = $(this).val();
        console.log('id is:',id);
        if (confirm("Είστε σίγουρος/η ότι θέλετε να κάνετε αυτόν τον χρήστη User?")==true) {
            $.post("makeuser.php",{idodu: id});
            event.preventDefault();
            location.reload();
            return true;
        } else {
            event.preventDefault();
        };
    });
</script>
<?php
	include 'footer.php';
?>
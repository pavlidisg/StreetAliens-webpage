<?php session_start(); ?>
<table class="container-lg">
	<?php 
	    require_once('dbfunctions.php');
	    $conn=db_connect();
	    $sql="select * from comments";
	    $result=mysqli_query($conn,$sql);
	    if(isset($_SESSION['user'])){
	        $cuser=$_SESSION['user'];
	    }
	    if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
			    $key=-1;
				$nm=$row['name'];
				$comm=$row['msg']; 
				$time=$row['timestamp'];
				$cid=$row['id'];
				$l=$row['likes'];
				$d=$row['dislikes'];
				if(isset($_SESSION['user'])){
    				$sql2="select * from cld where uwl='$cuser' and c_id='$cid' ";
                	$result2=mysqli_query($conn,$sql2);
                	if(mysqli_num_rows($result2)===1){
                        $row2=mysqli_fetch_assoc($result2);
                        $cld=$row2['lod'];
                        if(!strcmp($cld,'like')){
                            $key=1;
                        }else{
                            $key=0;
                        }
                	}
				} ?>
				<tr class="container-lg">
					<td class="container-lg"><p class="container-lg" style="font-size: 12px;"><?php echo htmlspecialchars($nm)." ".$time?><br> </p><b><?php echo htmlspecialchars($comm) ?></b><br><br>
					<button type="button" onclick="sublod('like',<?php echo $cid ?>);" id="" value="like" class="material-icons" style="<?php if($key==1){ ?> color: blue; <?php } ?> margin-right: 3px; font-size: 15px; border:none; ">thumb_up</button><?php echo $l?>
					<button type="button" onclick="sublod('dislike',<?php echo $cid ?>)" id="" value="dislike" class="material-icons" style="<?php if($key==0){ ?> color: blue; <?php } ?> margin-right: 3px;margin-left: 5px;font-size: 15px; border:none;">thumb_down</button><?php echo $d;?>
					</td>
				</tr><?php
			}
	    }
	    mysqli_close($conn);
	?>
	</table>
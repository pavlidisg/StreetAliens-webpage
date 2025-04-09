<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
		die();
	}
	require_once('dbfunctions.php');
    $conn=db_connect();
    $msgto=$_SESSION['msgto'];
            $cuser=$_SESSION['user'];
		if($msgto==="groupchat"){
			$sql="select * from chat where se='groupchat'";
		}else{
                	$sql="select * from chat where (apo='$cuser' and se='$msgto') or (apo='$msgto' and se='$cuser')";
		}
	        $result=mysqli_query($conn,$sql);?>
	        <table class="container-lg" id="bmipinaks><?php
	        if(mysqli_num_rows($result)>0){
			    while($row=mysqli_fetch_assoc($result)){
			        $msg=$row['message'];
			        $apo=$row['apo']; 
			        $time=$row['time']; 
			        if($apo===$cuser){?>
			            <tr class="container-lg">
			                <td style="float:right; border:none; margin:3px; background-color: blue; color:white;">
			                    <p class="container-lg" style="font-size: 10px;"><?php echo $time ?></p>
			                    <?php echo $msg ?>
			                </td>
			            </tr>
			 <?php  }else{ ?>
			            <tr class="container-lg">
			                <td style="float:left; border:none; margin:3px; background-color: #DCDCDC;"> 
			                    <p class="container-lg" style="font-size: 10px;"><?php if($msgto==="groupchat"){ echo $apo." ";} echo $time ?></p>
			                    <?php echo $msg ?>
			                </td>
			            </tr>
		<?php	 }
			       
			    }
	        } ?>
             </table>
    <?php mysqli_close($conn) ?>
<script>

var out = document.getElementById("asb");
var isScrolledToBottom = out.scrollHeight - out.clientHeight <= out.scrollTop + 100;

if(isScrolledToBottom){
    out.scrollTop = out.scrollHeight - out.clientHeight;}
</script>


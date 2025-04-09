<?php 
    session_start();
    if(!isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Unauthorized access!</b><br>redirect in 2s...";
		die();
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

</style>
</head>
<body>
<?php
    include 'navbar.php';
?>

<div class="container">
    <form method="POST"> 
    Chat with:
        <select class="select923" id="msgto" name="msgto">
            <option value="select923" selected disabled>Select..</option>
            <option value="groupchat" >Group chat</option>
<?php   require_once('dbfunctions.php');
    	$conn=db_connect();
    	$cuser=$_SESSION['user'];
    	$sql="select * from users";
    	$result=mysqli_query($conn,$sql); 
    	if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){ 
			    $un=$row['username']; 
			    if(!($un===$cuser)){ ?>
    	            <option value="<?php echo $un ?>"><?php echo $un ?></option>
   <?php  	    } 
      }
        } ?>
        </select>
        <button type="submit" id="chatwith" class="yoyoy" name="yoyoy"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-chat-left-text" viewBox="0 0 16 16">
  <path d="M14 1a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H4.414A2 2 0 0 0 3 11.586l-2 2V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12.793a.5.5 0 0 0 .854.353l2.853-2.853A1 1 0 0 1 4.414 12H14a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
  <path d="M3 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5zM3 6a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9A.5.5 0 0 1 3 6zm0 2.5a.5.5 0 0 1 .5-.5h5a.5.5 0 0 1 0 1h-5a.5.5 0 0 1-.5-.5z"/>
</svg></button> 

<a href="#" data-toggle="tooltip" data-placement="right" title="Επιλέξτε έναν χρήστη και έπειτα πατήστε το κουμπί δίπλα για να συνομιλήσετε." style="font-size:22px;margin-left:5px; background-color:white;cursor: pointer; color: #8B0000; border:none; text-decoration: none;" class="fa">&#xf059;</a>
  
    </form>
    <?php if(isset($_POST['yoyoy'])){
            $msgto=$_POST['msgto'];
            $_SESSION['msgto']=$msgto;
            $cuser=$_SESSION['user'];
	        $result=mysqli_query($conn,$sql);?>
	        <hr>
	        <h4>Chat with: <?php echo $msgto ?></h4>
	        <hr>
	        <div class="asb" id="asb" style="height: 300px; overflow-y:auto;">
     <?php    
		if($msgto==="groupchat"){
			$sql="select * from chat where se='groupchat'";
		}else{
                	$sql="select * from chat where (apo='$cuser' and se='$msgto') or (apo='$msgto' and se='$cuser')";
		}
    	        $result=mysqli_query($conn,$sql);?>
	        <table ><?php
	        if(mysqli_num_rows($result)>0){
			    while($row=mysqli_fetch_assoc($result)){
			        $msg=$row['message'];
			        $apo=$row['apo']; 
			        $time=$row['time']; 
			        if($apo===$cuser){?>
			            <tr>
			                <td style="float:right; border:none; background-color: blue; color:white;">
			                    <p style="font-size: 10px;"><?php echo $time ?></p>
			                    <?php echo $msg ?>
			                </td>
			            </tr>
			 <?php  }else{ ?>
			            <tr>
			                <td style="float:left; border:none; background-color: #DCDCDC">
			                    <p style="font-size: 10px;"><?php echo $time ?></p>
			                    <?php echo $msg ?>
			                </td>
			            </tr>
		<?php	 }
			       
			    }
	        } ?>
             </table>
            </div>
  <?php    ?>
        
        <hr style="border: 1px solid black">
        <form id="postchat">
            <textarea id="chatmsg" style="width: 80%; border: 2px solid black;" required></textarea>
            <button name="subchat" type="submit" style="background-color: white; border:none; margin-left: 5px;position: absolute;top -10px;"><i class="fa fa-send-o" style="font-size:35px;color:blue;margin-left:5px;"></i></button><br>
        </form> 

            <div class="dropdown dropright">
                <button data-toggle="dropdown" style="background-color:white;">&#128512;</button>
                <div class="dropdown-menu" style="width: 170px;">
                    <button type="button" onclick="emoj('&#128512;');" class="emojis">&#128512;</button>
                    <button type="button" onclick="emoj('&#128514;');" class="emojis">&#128514;</button>
                    <button type="button" onclick="emoj('&#128515;');" class="emojis">&#128515;</button>
                    <button type="button" onclick="emoj('&#128516;');" class="emojis">&#128516;</button>
                    <button type="button" onclick="emoj('&#128517;');" class="emojis">&#128517;</button>
                    <button type="button" onclick="emoj('&#128518;');" class="emojis">&#128518;</button>
                    <button type="button" onclick="emoj('&#128519;');" class="emojis">&#128519;</button>
                    <button type="button" onclick="emoj('&#128526;');" class="emojis">&#128526;</button>
                    <button type="button" onclick="emoj('&#128539;');" class="emojis">&#128539;</button>
                </div>
            </div><?php   }?>
</div>
    
<?php
	include 'footer.php';
?>  

<script>
    $.ajaxSetup ({
        cache: false
    });

    $(document).ready(function(){
        setInterval(function(){
            $('#asb').load('loadmessages.php');
        },1000); 
        $('.asb').scrollTop($('.asb')[0].scrollHeight);
    });
    
    $(document).ready(function(){
        $("#postchat").submit(function(event){
            event.preventDefault();
            var msg = document.getElementById("chatmsg").value;
            $.post("submitchat.php",{chatmsg: msg},function(data){
                console.log(data);
            })
            document.getElementById("chatmsg").value= "" ;
        });
    });    

    let input = document.querySelector(".select923");
    let button = document.querySelector(".yoyoy");
    
    button.disabled = true; 
    
    input.addEventListener("change", stateHandle);
    
    function stateHandle() {
      if (input.value === "select923") {
            button.disabled = true; 
      } else {
            button.disabled = false; 
      }
    }
    
    $(document).ready(function(){
      $('[data-toggle="tooltip"]').tooltip();   
    });
    
    function emoj(e) {
        event.preventDefault();
        var msg = document.getElementById("chatmsg").value;
        document.getElementById("chatmsg").value= msg + e ;
    }

</script>

</body>
</html>
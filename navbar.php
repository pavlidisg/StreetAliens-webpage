<nav class="navbar navbar-expand-sm bg-dark navbar-dark sticky-top">
  <a class="navbar-brand" href="index"><img src="salogo.png" style="width:45px;height:45px; border: static;"><em> Street Aliens </em></a>
  <!-- Toggler/collapsibe Button -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>
  
  <!-- Navbar links -->
  <div class="collapse navbar-collapse" id="collapsibleNavbar">
	<ul class="navbar-nav ml-auto">

<li class="nav-item active"><a class="nav-link" href="index" style="margin-right: 15px" >Home<svg width="25px" height="25px" viewBox="0 0 16 16" class="bi bi-house" fill="white" xmlns="http://www.w3.org/2000/svg" style="margin-left: 5px;">
        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z"/>
        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z"/>
         </svg></a></li>
		<li class="nav-item dropdown active"><a class="nav-link dropdown-toggle" toggle="tab" href="" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Social Media</a>
		    <div class="dropdown-menu" style="background-color: #303030; opacity:0.95;" aria-labelledby="navbarDropdown">
			  <a class="dropdown-item button1 fa fa-youtube" style="color: white;" href="https://www.youtube.com/channel/UC2rNfqiY_Qu2Ny3uGQkQ_mw" target="_blank">        YouTube Channel</a>
			  <a class="dropdown-item button1 fa fa-facebook" style="color: white;" href="https://www.facebook.com/StreetAliens-103064241595671" target="_blank">          Facebook Page</a>
			  <a class="dropdown-item button1 fa fa-instagram" style="color: white;" href="https://www.instagram.com/street__aliens/" target="_blank">                     Instagram Page</a>
            </div>			
		</li>
		<li class="nav-item dropdown active"><a  class="nav-link dropdown-toggle" toggle="tab" href="" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Coaches</a>
          <div class="dropdown-menu" style="background-color: #303030; opacity:0.95;" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item button1" style="color: white;" href="c-alex">Alex</a>
		  <a class="dropdown-item button1" style="color: white;" href="c-intz">Panos</a>
		  </div>
		</li>
		<?php if(!isset($_SESSION['user'])){?>
		<li class="nav-item active button1"><a  class="nav-link" href="register" >Register</a></li>
		<li class="nav-item active button1"><a class="nav-link" href="login" >Login<svg width="30px" height="30px" viewBox="0 0 16 16" class="bi bi-person-circle" fill="white" xmlns="http://www.w3.org/2000/svg" style="margin-left: 5px;">
           <path d="M13.468 12.37C12.758 11.226 11.195 10 8 10s-4.757 1.225-5.468 2.37A6.987 6.987 0 0 0 8 15a6.987 6.987 0 0 0 5.468-2.63z"/>
           <path fill-rule="evenodd" d="M8 9a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/>
           <path fill-rule="evenodd" d="M8 1a7 7 0 1 0 0 14A7 7 0 0 0 8 1zM0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8z"/>
        </svg></a></li><?php }else{
            $u=$_SESSION['user'];
            if($_SESSION['role']==='admin'){?>
                <li class="nav-item active button1"><a  class="nav-link" href="manageusers" >Manage users</a></li>
            <?php }?>
            <li class="nav-item active button1"><a class="nav-link" href="chat">Chat<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" style="margin-left: 7px; margin-right: 5px;" fill="currentColor" class="bi bi-chat-dots" viewBox="0 0 16 16">
  <path d="M5 8a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm4 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm3 1a1 1 0 1 0 0-2 1 1 0 0 0 0 2z"/>
  <path d="M2.165 15.803l.02-.004c1.83-.363 2.948-.842 3.468-1.105A9.06 9.06 0 0 0 8 15c4.418 0 8-3.134 8-7s-3.582-7-8-7-8 3.134-8 7c0 1.76.743 3.37 1.97 4.6a10.437 10.437 0 0 1-.524 2.318l-.003.011a10.722 10.722 0 0 1-.244.637c-.079.186.074.394.273.362a21.673 21.673 0 0 0 .693-.125zm.8-3.108a1 1 0 0 0-.287-.801C1.618 10.83 1 9.468 1 8c0-3.192 3.004-6 7-6s7 2.808 7 6c0 3.193-3.004 6-7 6a8.06 8.06 0 0 1-2.088-.272 1 1 0 0 0-.711.074c-.387.196-1.24.57-2.634.893a10.97 10.97 0 0 0 .398-2z"/>
</svg></a></li>
<li class="nav-item dropdown active"><a  class="nav-link dropdown-toggle" toggle="tab" href="" id="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-right:10px"><svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-sliders" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M11.5 2a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM9.05 3a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0V3h9.05zM4.5 7a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zM2.05 8a2.5 2.5 0 0 1 4.9 0H16v1H6.95a2.5 2.5 0 0 1-4.9 0H0V8h2.05zm9.45 4a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-2.45 1a2.5 2.5 0 0 1 4.9 0H16v1h-2.05a2.5 2.5 0 0 1-4.9 0H0v-1h9.05z"/>
</svg></a>
  <div class="dropdown-menu" style="background-color: #303030; opacity:0.95; float:left;" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item button1" onclick="condel(event)" style="color: white;" href="delacc">Delete account</a>
		  <a class="dropdown-item button1" style="color: white;" href="changepass">Change password</a>
		  </div>
</li>
            <li class="nav-item active button1"><a class="nav-link" style="color:white;" href="logout" > <?php echo $u?>  Logout<svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" style="margin-left: 5px;" class="bi bi-box-arrow-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M10 12.5a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-9a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v2a.5.5 0 0 0 1 0v-2A1.5 1.5 0 0 0 9.5 2h-8A1.5 1.5 0 0 0 0 3.5v9A1.5 1.5 0 0 0 1.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-2a.5.5 0 0 0-1 0v2z"/>
  <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 0 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
</svg></a></li>
            <?php }?>
            
	</ul>
  </div>
</nav> 
<script>
    function condel(event){
        
        if (confirm("Είστε σίγουρος/η ότι θέλετε να διαγράψετε οριστικά αυτόν τον λογαριασμό?")==true) {
            return true;
        } else {
            event.preventDefault();
        };
    };
</script>
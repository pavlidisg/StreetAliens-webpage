<form action="" method="post">
<div class="container">
    <h3>Login</h3><hr>
    <label for="uname"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;">
	<br><br>
    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;">
	<br><br>
        
    <button class="btn" name="login" type="submit">Login</button>
    <label>
      <input type="checkbox" name="remember"> Remember me
    </label>
	 <span class="psw">Forgot <a href="resetpas.php?rpform">password?</a></span>
</div>
</form>
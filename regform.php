<?php $un = $pass = $email = "" ?>
<form onsubmit="checkform(this)" action="" method="post">
    <h3>Create an account</h3><hr>
	<label for="email"><span class="error">* </span><b>Email</b></label>
    <input type="email" placeholder="Enter your email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];} ?>" required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;">
    <br><br>
	
    <label for="uname"><span class="error">* </span><b>Username</b></label>
    <input type="text" id="uname" placeholder="Enter Username" name="uname"
	title="Username must have at least 6 characters" required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;">
	<div id="message3"><p id="unc" class="invalid">Must contain: at least 6 characters<br>Numbers and letters only!</p></div>
	<br><br>
   
    <label for="psw"><span class="error">* </span><b>Password</b></label>
    <input type="password" id="psw" placeholder="Enter Password" name="psw"
    maxlength=20 pattern="(?=.*\d).{8,}" title="Must contain at least one number and at least 8 characters with no spaces. Maximum 20 characters"  
	required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;" ><div id="message">
	<p id="pswconf" class="invalid">Must contain: 8-20 characters , at least 1 number<br>Numbers and letters only!</p></div>
	<br><br>
	
	<label for="psw"><span class="error">* </span><b>Confirm Password</b></label>
    <input type="password" id="pswco" maxlength=16 placeholder="Confirm Password" name="confpsw" 
	title="Passwords must match" required onkeydown="if(event.keyCode == 32 || event.keyCode == 187) return false;">
	<div id="message2"><p id="pswmatch" class="invalid">Passwords do not match!</p></div>
	<br>
	
	<p><span class="error">* required field</span></p>
        
    <button class="btn" name="register" type="submit"><b>Create Account</b></button>
</form>
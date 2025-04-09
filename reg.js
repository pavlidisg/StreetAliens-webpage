  function checkForm(form){
    psw1 = form.psw.value;
	psw2 = form.confpsw.value;
	un = form.uname.value;
	if (psw1 != psw2)
	  alert ("passwords do not match\nTry again");
	  return false;
  }
  
var myPsw = document.getElementById("psw");
var pswv = document.getElementById("pswconf");
var myCopsw = document.getElementById("pswco");
var pswco = document.getElementById("pswmatch");
var myUsername = document.getElementById("uname");
var usrname = document.getElementById("unc");

// When the user clicks on the username field, show the message box
myUsername.onfocus = function() {
  document.getElementById("message3").style.display = "inline";
};

// When the user clicks outside of the username field, hide the message box
myUsername.onblur = function() {
  document.getElementById("message3").style.display = "none";
};

// When the user starts to type something inside the username field
myUsername.onkeyup = function() {

  // Validate length
  if(myUsername.value.length >= 6) {
    usrname.classList.remove("invalid");
    usrname.classList.add("valid");
  } else {
    usrname.classList.remove("valid");
    usrname.classList.add("invalid");
  }
};

// When the user clicks on the password field, show the message box
myPsw.onfocus = function() {
  document.getElementById("message").style.display = "inline";
};

// When the user clicks outside of the password field, hide the message box
myPsw.onblur = function() {
  document.getElementById("message").style.display = "none";
};

// When the user starts to type something inside the password field
myPsw.onkeyup = function() {

  // Validate numbers
  var numbers = /[0-9]/g;
  if(myPsw.value.match(numbers) && (myPsw.value.length >= 8)) {  
    pswv.classList.remove("invalid");
    pswv.classList.add("valid");
  } else {
    pswv.classList.remove("valid");
    pswv.classList.add("invalid");
  }
    
};

// When the user clicks on the password field, show the message box
myCopsw.onfocus = function() {
  document.getElementById("message2").style.display = "inline";
};

// When the user clicks outside of the confirm password field, hide the message box
myCopsw.onblur = function() {
  document.getElementById("message2").style.display = "none";
};

// When the user starts to type something inside the confirm password field
myCopsw.onkeyup = function() {

  // Check the password matching
  if(myCopsw.value.match(myPsw.value)) {  
    pswmatch.classList.remove("invalid");
    pswmatch.classList.add("valid");
    document.getElementById("pswmatch").innerHTML = "Passwords match!";
  } else {
    pswmatch.classList.remove("valid");
    pswmatch.classList.add("invalid");
    document.getElementById("pswmatch").innerHTML = "Passwords do not match!";
  }
};
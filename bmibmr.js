function bmi(form){
    a = form.age.value
	w = form.weight.value
	h = form.height.value
    h = h/100;
	bmires = w / (h ** 2);
	bmires = bmires.toFixed(2);
    document.getElementById("result").innerHTML ="<br>BMI = " + bmires + " kg/cm2<br>Δείτε τον παρακάτω πίνακα.";
	var y = document.getElementById("shbtn");
	y.style.display = "inline";

}

function bmr(form){
	var s = form.sex.value;
    var a = form.age2.value;
	var w = form.w2.value;
	var h = form.he2.value;
	var l = document.getElementById("askh");
	l = l.value;
	var bmrres = 0;
	if(s=="male"){
		bmrres = 66 + (13.7 * w) + (5 * h) - (6.8 * a);
	}else{
		bmrres = 655 + (9.6 * w) + (1.8 * h) - (4.7 * a);
	}
	var amrres=0;
	if(l=="mikrh"){
		amrres = bmrres * 1.2 ;
	}else if(l=="metria"){
		amrres = bmrres * 1.375 ;
	}else if(l=="entonh"){
		amrres = bmrres * 1.55 ;
	}else if(l=="daily"){
		amrres = bmrres * 1.725 ;
	}else{
		amrres = bmrres * 1.9 ; 
	}
	bmrres = bmrres.toFixed(2);
	amrres = amrres.toFixed(2);
	document.getElementById("resu").innerHTML = "<br>BMR= " + bmrres +" kcal/μέρα" + "<br>" + "AMR= " + amrres +" kcal/μέρα";

}

function showHide() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
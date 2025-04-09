<?php 
    session_start();
    if(isset($_COOKIE['username'])) {
        $_SESSION['user']=$_COOKIE['username'];
        $cuser= $_SESSION['user'];
        require_once('dbfunctions.php');
		$conn=db_connect();
		$sql="select * from users where username='$cuser'";
		$result=mysqli_query($conn,$sql);
		$row=mysqli_fetch_assoc($result);
		if($row['role']==='admin'){
		    $_SESSION['role']='admin';
		}else{
			$_SESSION['role']='user';
		}
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
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link rel="stylesheet" href="bgnmore.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
  span.psw {
    float: right;
	text-decoration: underline;
  }
  
  .errmsg {
  padding: 15px;
  margin: 5px;
  background-color: #f44336;
  color: white;
}
</style>
</head>
<body>
    <?php include("navbar.php"); ?>


  <div class="container-sm" style="text-align: center-top;">
    <p><h4><b>Καλώς ορίσατε στην ιστοσελίδα μας!</b></h4><br> Η ομάδα μας λέγετε StreetAliens και δημιουργήθηκε στις αρχές του 2019, στο Πολύκαστρο,Κιλκίς από τους : Άλεξ και Παναγιώτη. Ο σκοπός  μας είναι να φτάσουμε το ανώτατο επίπεδο στον κόσμο της καλλισθενικής γυμναστικής και να βοηθήσουμε όσους θέλουν να πετύχουν τους στόχους τους στην γυμναστική , με τις γνώσεις και τις εμπειρίες μας. Θέλουμε να ενώσουμε τα άτομα που τους ενδιαφέρει ο τομέας μας και έτσι να δημιουργήσουμε μια παρέα γυμναστικής που θα μεγαλώνει όλο και περισσότερο. Με τον καιρό προστίθενται και άλλα μέλη στην ομάδα , τα οποία έχουν όρεξη για γυμναστική και έχουν στόχους , τα οποία είναι και αυτά που θέλουμε να βλέπουμε. Είναι χαρά μας να σας δεχτούμε στην παρέα μας και να σας βοηθήσουμε όσο μπορούμε να γίνεται καλύτεροι αθλητές και να φτάσετε τους στόχους σας. </p>
        <img class="sateam" src="sateam.jpg">
  </div>

  <div class="container-lg" style="overflow:auto;">
	<form action="" onsubmit="bmi(this);return false;"  method="get">
		<div class="container col-sm-6" style="float:left;" >
			<h3>Υπολογισμός Δείκτη Μάζας Σώματος (BMI)</h3>
			<hr>
			<label for=""><b></b><b>Age: </b></label>
			<input type="number" name="age" id="age1" style="width:25%;"  ><br>
			<label for=""><b></b><b>Weight (in kg): </b></label>
			<input type="number" name="weight" id="w1" style="width:25%;"  > kg.<br>
			<label for=""><b></b><b>Height (in cm): </b></label>
			<input type="number" name="height" id="hi1" style="width:25%;" > cm.<br>

			<input type="submit" value="Calculate" style="background-color: #DC143C ;" >
			<button type="button" onclick="location.reload();">refresh</button>
			<br>
			<div id="results" ><p id="result"></p></div><hr>
			<button id="shbtn" style="float:left; display:none;" type="button"onclick="showHide()">Πίνακας ΒΜΙ</button>
			<div style="display: none;" id="myDIV">
			    <br><br>
				<table id="bmipinaks" style="overflow:auto;">
					<tr>
						<th>Αξιολόγηση</th>
						<th>BMI</th>
					</tr>
					<tr>
						<td>Ελλιποβαρής</td>
						<td><18,5</td>
					</tr>
					<tr>
						<td>Φυσιολογικό βάρος</td>
						<td>18,5 -24,99</td>
					</tr>
					<tr>
						<td>Υπέρβαρος</td>
						<td>≥25</td>
					</tr>
					<tr>
						<td>Προ-παχυσαρκία</td>
						<td>25,0-29,99</td>
					</tr>
					<tr>
						<td>Παχυσαρκία</td>
						<td>≥30</td>
					</tr>
					<tr>
						<td>Παχυσαρκία τύπου A' </td>
						<td>30,0–34,99</td>
					</tr>
					<tr>
						<td>Παχυσαρκία τύπου B' </td>
						<td>35,0–39,99</td>
					</tr>
					<tr>
						<td>Παχυσαρκία τύπου Γ' </td>
						<td>>40,0 </td>
					</tr>
				</table>
			</div>
		</div>
	</form>
	<div class="container col-sm-6" style="overflow:auto;" >
		<p style="text-align: center;"><b><u>Δείκτης BMI</u></b></p>
          <p>  Ο ορισμός Δείκτης μάζας σώματος (ΔΜΣ, body mass index (BMI), ή Quetelet index) είναι μία γενική ιατρική ένδειξη για τον υπολογισμό του βαθμού παχυσαρκίας ενός ατόμου. Λόγω του εύκολου υπολογισμού του είναι ένα ευρέως διαδεδομένο διαγνωστικό εργαλείο των πιθανών προβλημάτων υγείας ενός ατόμου σε σχέση με το βάρος του. Δημιουργήθηκε το 1832 από τον Adolphe Quetelet. Υπολογίζεται πολύ εύκολα από τον τύπο:
                ΔΜΣ = βάρος(kg) / (ύψος)2 (m2).

		</p>
	</div>
</div>


<div class="container-lg" style="overflow:auto;">
	<form action="" onsubmit="bmr(this);return false;"  method="get">
		<div class="container col-sm-6"  style="float:left;" >
			<h3>Υπολογισμός Βασικoύ Ρυθμού Μεταβολισμού (BMR) -<br> Ενεργού Ρυθμού Μεταβολισμού (ΑMR)</h3>
			<hr>
            <form>
				<label for="male"><b>Male</b></label>
				<input type="radio" id="sex" name="gender" value="male">
				<label for="female"><b>Female</b></label>
				<input type="radio" id="sex" name="gender" value="female"><br>
            </form>
			<label for=""><b></b><b>Age: </b></label>
			<input type="number" name="age" id="age2" style="width:25%;" required><br>
			<label for=""><b></b><b>Weight (in kg): </b></label>
			<input type="number" name="weight" id="w2" style="width:25%;"  required> kg.<br>
			<label for=""><b></b><b>Height (in cm): </b></label>
			<input type="number" name="height" id="he2" style="width:25%;" required> cm.<br>
			<label for=""><b></b><b>Φυσική Δραστηριότητα: </b></label><br>
			<select style="width:30%;" id="askh">
				<option value="" selected>Options...</option>
				<option value="mikrh">Πολύ Μικρή – Σπάνια Άσκηση</option>
				<option value="metria">Μέτρια – Άσκηση μέχρι 3 φορές την εβδομάδα</option>
				<option value="entonh">Έντονη – Άσκηση 3-5 φορές την εβδομάδα</option>
				<option value="daily">Καθημερινή – Άσκηση κάθε μέρα</option>
				<option value="athl">Αθλητική – Πολύ έντονη άσκηση κάθε μέρα</option>
			</select>
			<br><br>
 
			<input type="submit" value="Calculate" style="background-color: #DC143C ;">
			<button  type="button" onclick="location.reload();">refresh</button>

			<div id="results" ><p id="resu"></p></div><hr>
		</div>
	</form>

	<div class="container col-sm-6" style="overflow:auto;">
		<p style="text-align: center;"><b><u>Δείκτης BMR</u></b></p>
		<p>Ο Βασικός Μεταβολικός Ρυθμός (BMR Basal Metabolic Rate) καθώς και ο Ενεργός Μεταβολικός Ρυθμός (AMR Active Metabolic Rate) μας δείχνουν πόσες θερμίδες καταναλώνει το σώμα μας μέσα σε μια μέρα. </p>
		
		<p>Η διαφορά του Βασικού με τον Ενεργό είναι ότι ο πρώτος υπολογίζει την ενέργεια που χρειαζόμαστε σε κατάσταση ηρεμίας, δηλαδή τις θερμίδες που χρειάζεται 
		το σώμα μας για να συντηρήσει της φυσιολογικές λειτουργίες του (Καρδιά, Εγκέφαλος κτλ.), ενώ ο δεύτερος υπολογίζει την ενέργεια που χρειάζεται ο οργανισμός μας 
		την ώρα που βρίσκεται σε κάποια φυσική δραστηριότητα.</p>
		
		<p> Ο Βασικός Μεταβολικός Ρυθμός αποτελεί το 75% (κατά μέσο όρο) των θερμίδων που καταναλώνουμε κάθε μέρα. Αντιθέτως, ο Ενεργός Μεταβολικός Ρυθμός κυμαίνεται βάση του 
		τρόπου ζωής που κάνουμε (πχ: καθιστική,  αθλητική κτλ.).</p>
		
		<p> Οι μεταβολικοί ρυθμοί πέρα από την σωματική άσκηση είναι ανάλογοι με το φύλο του ανθρώπου, το βάρος, το ύψος, καθώς και την ηλικία και υπολογίζονται μέσω μαθηματικών τύπων.</p>
	
		<p>Ο μαθηματικός τύπος υπολογισμού του Βασικού Μεταβολικού Ρυθμού είναι ο εξής: </p>
		
		<p>Γυναίκες: βασικό μεταβολικό ρυθμό = 655 + (9.6 x βάρος σε κιλά) + (1.8 x ύψος σε εκατοστά) – (4.7 x ηλικία σε χρόνια).<br>
		Άνδρες: βασικό μεταβολικό ρυθμό = 66 + (13.7 x βάρος σε κιλά) + (5 x ύψος σε εκατοστά) – (6.8 x ηλικία σε χρόνια).</p>
		<p>Παράλληλα, για να υπολογίσετε τον Ενεργό Μεταβολικό σας Ρυθμό θα πρέπει πρώτα να επιλέξετε τον τύπο και τη συχνότητα της καθημερινής φυσικής σας δραστηριότητας η οποία χωρίζεται σε 5 επίπεδα.</p>
		<p><ul> 
			<li>Πολύ Μικρή – Σπάνια Άσκηση<br>
				BMR x 1.2</li>
			<li>Μέτρια – Άσκηση μέχρι 3 φορές την εβδομάδα<br>
				BMR x 1.375</li>
			<li>Έντονη – Άσκηση 3-5 φορές την εβδομάδα<br>
				BMR x 1.55</li>			
			<li>Καθημερινή – Άσκηση κάθε μέρα<br>
				BMR x 1.725</li>
			<li>Αθλητική – Πολύ έντονη άσκηση κάθε μέρα<br>
				BMR x 1.9</li>				
		</ul>
		</p>
		<p>Με αυτό τον τρόπο μπορείτε εύκολα να υπολογίσετε τις καθημερινές ανάγκες του σώματος σας σε ενέργεια, δηλαδή σε θερμίδες,
		έτσι ώστε να γνωρίζετε πόση ενέργεια πρέπει να λαμβάνετε για να διατηρήσετε, να αυξήσετε, ή να μειώσετε το σωματικό σας βάρος. </p>
	
	</div>
</div>

<div class="container-xl" style="overflow:auto;">

<?php 
    
?>

<form action="" method="post">
  <div class="container col-sm-6" >
    <h3>Leave a comment</h3>
	<hr>
	<?php if(!isset($_SESSION['user'])){?>
    <label style="margin-top:15px;" for="name"><b>Name</b></label>
    <input type="text" placeholder="Enter your name" name="name" required>
	
	<label style="margin-top:15px;" for="email"><b>E-mail</b></label>
    <input type="email" placeholder="Enter your email" name="email" required>
    <?php }else{ 
        $u=$_SESSION['user']; ?>
        <p><b>Leave a comment as: <?php echo $u ?></b></p>
	<?php } ?>
	<label style="margin-top:15px;" for="text"><b>Comment</b></label>
	<hr>
    <textarea placeholder="Type your comment" style="width: 100%;" name="comm" required></textarea>

    <button class="btn" name="subcom" type="submit" >Submit comment</button>

  </div>
</form>
</div>

<?php 
    if(isset($_POST['subcom'])){
        include 'subcom.php';
    }
?>

<div class="container">
	<h3 style="sticky-top;">Comments</h3>
	<hr>
	<div id="lerr" style="text-align: center; display:none;" class="errmsg">
        <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
        <b>Θα πρέπει να είστε εγγεγραμμένος χρήστης για να μπορείτε να δηλώσετε αν σας αρέσει ή όχι κάποιο σχόλιο!<br>Κάντε εγγραφή <a href="register">εδώ!</a></b>
	</div>
	<div class="lc" id="lc" style="height:400px; overflow:auto;">
	<table id="bmipinaks" class="container-lg">
	<?php 
	    require_once('dbfunctions.php');
	    $conn=db_connect();
	    $sql="select * from comments";
	    $result=mysqli_query($conn,$sql); 
	    if(mysqli_num_rows($result)>0){
			while($row=mysqli_fetch_assoc($result)){
				$nm=$row['name'];
				$comm=$row['msg']; 
				$time=$row['timestamp'];
				$cid=$row['id'];
				$l=$row['likes'];
				$d=$row['dislikes']; ?>
				<tr>
					<td><p style="font-size: 12px;"><?php echo htmlspecialchars($nm)." ".$time?><br> </p><b><?php echo htmlspecialchars($comm) ?></b><br><br>
					<button type="button" onclick="sublod('like',<?php echo $cid ?>);" id="" value="like" class="material-icons" style="margin-right: 3px; font-size: 15px; border:none;">thumb_up</button><?php echo $l?>
					<button type="button" onclick="sublod('dislike',<?php echo $cid ?>)" id="" value="dislike" class="material-icons" style="margin-right: 3px;margin-left: 5px;font-size: 15px; border:none;">thumb_down</button><?php echo $d ?>
					</td>
				</tr><?php
			}
	    }
	    mysqli_close($conn);
	?>
	</table>
	</div>
</div>

<script  src="bmibmr.js"  ></script>
<?php include("footer.php"); ?>

</body>
<script>
    $.ajaxSetup ({
        cache: false
    });
    
    /*$(document).ready(function(){
        setInterval(function(){
            $('#lc').load('lc.php');
        },1000); 
    });*/
        function sublod(lod,cid){
            event.preventDefault();
            <?php if(isset($_SESSION['user'])){ ?>
            $.post("subld.php",{lod: lod, cid: cid},function(data){
                console.log(data);
            }); <?php }else{ ?>
                var div = document.getElementById('lerr');
                div.style.display  = 'block';
         <?php   } ?>
            
        };
    
</script>
</html>
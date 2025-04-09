<?php session_start();
    if(isset($_SESSION['user'])){
        header("Refresh:2; url=index.php");
		echo "<b>Already a user!</b><br>redirect in 2s...";
		die();
	}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Street Aliens register</title>
  <link rel="shortcut icon" type="image/x-icon" href="salogo.png" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="pswvalidate.css">
  <link rel="stylesheet" href="bgnmore.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>	 

</style>
</head>
<body>
    
<?php 
    include("navbar.php");
?>

<div class="container">
    <?php
        if (isset($_POST['register'])){
            include 'sqlregister.php';
        }
        include 'regform.php';
    ?>
</div>

<?php include("footer.php"); ?>

<script src="reg.js"></script>

</body>
</html>
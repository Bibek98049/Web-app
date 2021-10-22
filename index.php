<?php 
      if(session_id() == '' || !isset($_SESSION)) {
          session_start();
      }
    ?> 

<!Doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<link rel="stylesheet" href="bootstrap.min.css">
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="style.css">
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
 <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
<title> Astra app </title>
</head>

<body>
<header>
		<div class="header">
		<a href="index.php"> <img src="logo.png" alt="logo loading" width="111" Height="111"> </a>
		<div class="logout">
		<?php if (isset($_SESSION['customer'])) { ?>
		<a class="lgo" href="logout.php">Logout</a>
		<a class="lgo" href="contact.php">Contact Us</a>
		<?php } ?>
		</div>
		<div class="logout">
			<?php 
		      if (!isset($_SESSION['customer'])) {?>
					<a class="lgo" href="login.php">Login</a>
					<a class="lgo" href="signup.php">Sign Up</a>
				<?php } ?>
		</div>
		  </div>
		  </header>
		  <div class="img-background"> <section><img src="background.png" width="100%" height="100%"> </div>



<div class="icon-bar">
<div class="panel-footer" id="myDIV" style="padding-top: 0; padding-bottom: 0;">
  <a class="btns" href="index.php"><i class="fa fa-home"></i></a>
    <a class="btns" href="addconference.php"><i class="fa fa-plus-circle"></i></a>
  <a class="btns" href="viewreport.php"><i class="fa fa-list"></i></a>
  <!-- <a href="#"><i class="fa fa-bell"></i></a> -->
  <a class="btns" href="profile.php"><svg xmlns="http://www.w3.org/2000/svg" width="35" height="38" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
</svg></a>

  </div>
</div>


</body>
</html>  
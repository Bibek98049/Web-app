<?php 
require "database.php";
$msg = ''; 
    if (isset($_POST['submit'])) {
        $password = $_POST['password'];
        $confirmpw = $_POST['confirmpw'];
        if ($password != $confirmpw) {
            $msg = "Password don't match. Please Try again!";
        }
        else{
            $stmt = $pdo->prepare("INSERT INTO users(firstname, lastname, email, password)
                VALUES(:firstname, :lastname, :email, :password)");
            $criteria = [
                'firstname' => $_POST['firstname'],
                'lastname' => $_POST['lastname'],
                'email' => $_POST['email'],  
                'password' => password_hash($_POST['password'], PASSWORD_DEFAULT)
            ];
            $stmt->execute($criteria);
            if ($stmt == true) {
                $msg = "Registered successfully";
                header('refresh:5;url=signup.php');
            }           
        }
    }
 ?>


<!Doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="signup.css">
<link rel="stylesheet" href="homepage.css">
<link rel="stylesheet" href="homepage.css">
<!-- <link rel="stylesheet" href="style.css"> -->
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

<div class="container">
	<div class="row">
		<div class="loginbox">
		<h1> Create an account </h1>
		<?php
			if (!empty($msg)) {
			 	echo '<p class="msg">'.$msg.'</p>';
			 }
		?>
		<form method="POST" action="">
		<label id="Fname">First Name</b></label>
		<input type="text" placeholder="Enter First Name" name="firstname" required >
		<br> <label id="Lname">Last Name</b></label>
		<input type="text" placeholder="Enter Last Name" name="lastname" required >
		<br> <label id="email"> Email Address</b></label>
		<input type="text" placeholder="Enter email address" name="email" required >
		<br> <label id="Choosepw">Choose Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" required >
		<br> <label id="Confirmpw">Confirm Password</b></label>
		<input type="password" placeholder="Confirm Password" name="confirmpw" required >
		<a href="#"><input type="submit" name="submit" value="Submit"> <br></a>
		</form>

		<p>Already have an account? <a href="login.php">Login</a></p>
		</div>
	</div>
</div>

</body>
</html>  
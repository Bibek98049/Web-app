<?php 
   if(session_id() == '' || !isset($_SESSION)) {
    session_start();
    }
    if (isset($_SESSION['customer'])) {
        header('location:index.php');
    }
    ?> 

<?php
require "database.php";
if (isset($_POST['submit'])) {
		$customer = $pdo->prepare("SELECT * FROM users WHERE email = :email");
		$criteria = [
			'email' => $_POST['email']
		];
		$fault = false;
		$customer->execute($criteria);
		if ($customer->rowCount()>0) {
			$user = $customer->fetch();
			if (password_verify($_POST['password'], $user['password'])) {
				session_start();
				$_SESSION['customer'] = $user['email'];
				$_SESSION['userId'] = $user['userId'];
				$_SESSION['start'] = time();
				$_SESSION['expire'] = $_SESSION['start'] + (1800);
				header('location:index.php');
			}
			else
				$fault = true;
		}
		else $fault = true;

		if ($fault == true) {
			$message = 'Username and Password doesn\'t matched!<br>Please try again!';
		}
	}

?>


<!Doctype html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="homepage.css">
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
		<!-- <div class="loginbox"> -->
		<h1> Login Here </h1>
		<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>
		<div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
			<div class="loginbox">
		<?php
			if (!empty($message)) {
			 	echo '<p class="rounded py-2 px-2 text-white bg-danger">'.$message.'</p>';
			 }
		?>
		<form method="POST" action="">
		<label id="uname"> <b>Username</b></label>
		<input type="email" placeholder="Enter Username" name="email" required >
		<br> <label id="psw"> <b>Password</b></label>
		<input type="password" placeholder="Enter Password" name="password" required  style="color: #000;">
		<input type="submit" name="submit" value="Login"> <br>
		<a href="forgotpw.php"> Forgot password ? </a> <br>
		<a href="signup.php"> Sign Up </a>
		</form>
		</div>
	</div>
		<div class="col-md-3 col-lg-3 col-xs-3 col-sm-3"></div>
		<!-- </div> -->
	</div>
</div>



<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>  

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

<style type="text/css">
header { font: normal 14px Verdana; }
h1 { font-size: 24px; }
h2 { font-size: 18px; }
#sidebar { float: right; width: 30%; }
#main { padding-right: 15px; margin-bottom: 50px;}
.infoWindow { width: 220px; }
</style>
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
<script type="text/javascript">

var map;

// Ban Jelačić Square - City Center
var center = new google.maps.LatLng(-25.2744, 133.7751);

var geocoder = new google.maps.Geocoder();
var infowindow = new google.maps.InfoWindow();

function init() {

var mapOptions = {
zoom: 4,
center: center,
mapTypeId: google.maps.MapTypeId.ROADMAP
}

map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

makeRequest('get_locations.php', function(data) {

var data = JSON.parse(data.responseText);

for (var i = 0; i < data.length; i++) {
displayLocation(data[i]);
}
});
}

</script>

<script type="text/javascript">
	function makeRequest(url, callback) {
	var request;
	if (window.XMLHttpRequest) {
	request = new XMLHttpRequest(); // IE7+, Firefox, Chrome, Opera, Safari
	} else {
	request = new ActiveXObject("Microsoft.XMLHTTP"); // IE6, IE5
	}
	request.onreadystatechange = function() {
	if (request.readyState == 4 && request.status == 200) {
	callback(request);
	}
	}
	request.open("GET", url, true);
	request.send();
	}






	function displayLocation(location) {

	var content =   '<div class="infoWindow"><strong>'  + location.title + '</strong>'
	+ '<br/>'     + location.location + '</div>';

	if (parseInt(location.lat) == 0) {
	geocoder.geocode( { 'address': location.address }, function(results, status) {
	if (status == google.maps.GeocoderStatus.OK) {

	var marker = new google.maps.Marker({
	map: map,
	position: results[0].geometry.location,
	title: location.title
	});

	google.maps.event.addListener(marker, 'click', function() {
	infowindow.setContent(content);
	infowindow.open(map,marker);
	});
	}
	});
	} else {
	var position = new google.maps.LatLng(parseFloat(location.lat), parseFloat(location.lon));
	var marker = new google.maps.Marker({
	map: map,
	position: position,
	title: location.title
	});

	google.maps.event.addListener(marker, 'click', function() {
	infowindow.setContent(content);
	infowindow.open(map,marker);
	});
	}
	}
</script>

<body onload="init();">

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

		  <section style="background:#fff; padding-bottom:40px;">
		  	<div class="container">
		  		<div class="text-center" style="padding-bottom: 3rem;">
		  			<h2>Post Research Conference</h2>
		  		</div>
				  <?php
					if (!empty($msg)) {
					 	echo '<p class="msg" style="text-align:center;">'.$msg.'</p>';
					 }
					?>
		  		<div class="row">
		  			<div class="col-md-12 col-lg-12">
		  				<div class="conference">
		  					<form method="POST" action="upload.php" enctype="multipart/form-data">
		  						<input type="hidden" name="submitted_by" value="<?php echo $_SESSION['userId']; ?>">
		  						<div class="frm">
										<label id="Fname">Conference Title</b></label>
										<input type="text" class="form-control" placeholder="Enter First Name" name="title" required >
									</div>
									<div class="frm">
										<label id="Lname">Location</b></label>
										<input type="text" class="form-control" placeholder="Enter Last Name" name="location" required >
									</div>
									<div class="frm">
										<label id="Lname">Latitude</b></label>
										<input type="text" class="form-control" placeholder="Enter Last Name" name="lat" required >
									</div>
									<div class="frm">
										<label id="Lname">Longitude</b></label>
										<input type="text" class="form-control" placeholder="Enter Last Name" name="lon" required >
									</div>
									<div class="frm">
										<label id="document"> Upload Files</b></label>
										<input type="file" class="form-control" name="file1" id="document" required="">
										<p><small>Only pdf file</small></p>
									</div>
									<?php if(isset($_SESSION['customer'])){ ?>
								<input type="submit" name="submit" value="Submit">
								<?php } else { ?> 
									<input type="submit" name="submit" value="Submit" disabled>
									<small class="text-muted">You are not logged in. Please login to Apply</small>
								<?php } ?>
									
								</form>
		  				</div>
		  			</div>
		  		</div>
		  	</div>
		  </section>



<header style="padding-left: 100px; padding-right: 100px; padding-bottom: 50px;">
		<h1>Latest Posted Location</h1>

	<section id="sidebar">
	<div id="directions_panel"></div>
	</section>

	<section id="main">
	<div id="map_canvas" style="width: 100%; height: 500px;"></div>
	</section>
</header>





		  

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
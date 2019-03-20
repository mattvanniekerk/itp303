<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Confirmation</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-5 mb-3">Confirmation</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	
	<div class="container">

		<div class="row mt-3">
			<div>
				<?php
					date_default_timezone_set('America/Los_Angeles');
					echo "This form was submitted on ";
					echo date('l, F j, Y');
					echo " at ";
					echo date('g:i:s A')
				?>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-4 text-right">Full Name:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if ( isset($_POST["fname"]) && !empty($_POST["fname"]) && isset($_POST["lname"]) && !empty($_POST["lname"]) ) {
						echo $_POST["fname"] . " " . $_POST["lname"];
					} else {
						echo "<em class=\"text-danger\">Not provided</em>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-4 text-right">Email:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if ( isset($_POST["email"]) && !empty($_POST["email"]) ) {
						echo $_POST["email"];
					} else {
						echo "<em class=\"text-danger\">Not provided</em>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-4 text-right">Phone:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if ( isset($_POST["phone"]) && !empty($_POST["phone"]) ) {
						echo $_POST["phone"];
					} else {
						echo "<em class=\"text-danger\">Not provided</em>";
					}
				?>
				
			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-4 text-right">Gender:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if ( isset($_POST["gender"]) && !empty($_POST["gender"]) ) {
						echo $_POST["gender"];
					} else {
						echo "<em class=\"text-danger\">Not provided</em>";
					}
				?>

			</div>
		</div> <!-- .row -->
		<div class="row mt-3">
			<div class="col-4 text-right">Password Match:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if ( (!isset($_POST["pass"]) || empty($_POST["pass"])) && (!isset($_POST["pass-confirm"]) || empty($_POST["pass-confirm"])) ) {
						echo "<em class=\"text-danger\">Not provided</em>";
					} else if ($_POST["pass"] != $_POST["pass-confirm"]) {
						echo "<em class=\"text-danger\">Passwords do not match</em>";
					} else {
						echo "<em class=\"text-success\">Passwords match</em>";
					}
				?>
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Verification Method:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if ( isset($_POST["verification-method"]) && !empty($_POST["verification-method"]) ) {
						echo $_POST["verification-method"];
					} else {
						echo "<em class=\"text-danger\">Not provided</em>";
					}
				?>
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-3">
			<div class="col-4 text-right">Terms & Conditions:</div>
			<div class="col-8">
				<!-- PHP Output Here -->
				<?php
					if ( isset($_POST["terms-accepted"]) ) {
						echo "<em class=\"text-success\">Accepted</em>";
					} else {
						echo "<em class=\"text-danger\">Not accepted</em>";
					}
				?>
				
			</div>
		</div> <!-- .row -->

		<div class="row mt-4 mb-4">
			<a href="form.php" role="button" class="btn btn-primary">Back to Form</a>
		</div> <!-- .row -->

	</div> <!-- .container -->

</body>
</html>
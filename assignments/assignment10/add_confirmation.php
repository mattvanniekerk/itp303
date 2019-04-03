<?php
	if( !isset($_POST["title"]) || empty($_POST["title"]) ) 
	{
		// Display a nice looking error message to the user
		$error = "Please fill out the required fields.";
	} 
	else
	{
		// Establish DB connection
		$host = "303.itpwebdev.com";
		$user = "vannieke_db_user";
		$pass = "BigHac%1996";
		$db = "vannieke_dvd_db";

		$mysqli = new mysqli($host, $user, $pass, $db);

		if ($mysqli->connect_errno) {
			echo "MySQL Connection Error: " . $mysqli->connect_errno;
			exit();
		}

		// Generate SQL
		$sql = "INSERT INTO dvd_titles (title";

		if ( isset($_POST["release_date"]) && !empty($_POST["release_date"]) ) {
			$sql = $sql . ", release_date";
		}

		if ( isset($_POST["label_id"]) && !empty($_POST["label_id"]) ) {
			$sql = $sql . ", label_id";
		}

		if ( isset($_POST["sound_id"]) && !empty($_POST["sound_id"]) ) {
			$sql = $sql . ", sound_id";
		}

		if ( isset($_POST["genre_id"]) && !empty($_POST["genre_id"]) ) {
			$sql = $sql . ", genre_id";
		}

		if ( isset($_POST["rating_id"]) && !empty($_POST["rating_id"]) ) {
			$sql = $sql . ", rating_id";
		}

		if ( isset($_POST["format_id"]) && !empty($_POST["format_id"]) ) {
			$sql = $sql . ", format_id";
		}

		if ( isset($_POST["award"]) && !empty($_POST["award"]) ) {
			$sql = $sql . ", award";
		}

		$sql = $sql . ")
				SELECT '" . $_POST["title"] . "'";

		if ( isset($_POST["release_date"]) && !empty($_POST["release_date"]) ) {
			$sql = $sql . ", '" . $_POST["release_date"] . "'";
		}

		if ( isset($_POST["label_id"]) && !empty($_POST["label_id"]) ) {
			$sql = $sql . ", " . $_POST["label_id"];
		}

		if ( isset($_POST["sound_id"]) && !empty($_POST["sound_id"]) ) {
			$sql = $sql . ", " . $_POST["sound_id"];
		}

		if ( isset($_POST["genre_id"]) && !empty($_POST["genre_id"]) ) {
			$sql = $sql . ", " . $_POST["genre_id"];
		}

		if ( isset($_POST["rating_id"]) && !empty($_POST["rating_id"]) ) {
			$sql = $sql . ", " . $_POST["rating_id"];
		}

		if ( isset($_POST["format_id"]) && !empty($_POST["format_id"]) ) {
			$sql = $sql . ", " . $_POST["format_id"];
		}

		if ( isset($_POST["award"]) && !empty($_POST["award"]) ) {
			$sql = $sql . ", '" . htmlspecialchars($_POST["award"]) . "'";
		}

		$sql = $sql . ";";

		// Submit SQL
		$submit = $mysqli->query($sql);

		if (!$submit) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		// Close connection
		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Add Confirmation | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="add_form.php">Add</a></li>
		<li class="breadcrumb-item active">Confirmation</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Add a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">

				<?php
					if (isset($error) && !empty($error)) {
						echo "<div class=\"text-danger font-italic\">" . $error . "</div>";
					} else {
						echo "<div class=\"text-success\"><span class=\"font-italic\">" . $_POST["title"] . "</span> was successfully added.</div>";
					}
				?>
				

				
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="add_form.php" role="button" class="btn btn-primary">Back to Add Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>
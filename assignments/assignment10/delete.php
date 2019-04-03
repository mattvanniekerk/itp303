<?php
	if( !isset($_GET["dvd_title_id"]) || empty($_GET["dvd_title_id"])
		|| !isset($_GET["title"]) || empty($_GET["title"]) ) 
	{
		// Display a nice looking error message to the user
		$error = "Invalid DVD title ID.";
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

		$mysqli->set_charset('utf8');
		// Generate SQL
		$sql = "DELETE FROM dvd_titles
				WHERE dvd_title_id = " . $_GET["dvd_title_id"] . ";";
		
		// Submit SQL
		$results = $mysqli->query($sql);

		if (!$results) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Delete a DVD | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Delete</li>
	</ol>
	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">Delete a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	<div class="container">
		<div class="row mt-4">
			<div class="col-12">
				<?php
					if (isset($error) && !empty($error)) {
						echo "<div class=\"text-danger\">" . $error . "</div>";
					} else {
						echo "<div class=\"text-success\"><span class=\"font-italic\">" . $_GET["title"] . "</span> was successfully deleted.</div>";
					}
				?>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_results.php" role="button" class="btn btn-primary">Back to Search Results</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container -->
</body>
</html>
<?php
	if( !isset($_GET["dvd_title_id"]) || empty($_GET["dvd_title_id"]) ) 
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

		// Generate SQL
		$sql = "SELECT dvd_titles.dvd_title_id AS dvd_title_id,
					dvd_titles.title AS title, 
					dvd_titles.release_date AS release_date, 
					genres.genre AS genre, 
					labels.label AS label,
					ratings.rating AS rating,
					sounds.sound AS sound,
					formats.format AS format,
					dvd_titles.award AS award
				FROM dvd_titles
				LEFT JOIN genres USING (genre_id)
				LEFT JOIN labels USING (label_id)
				LEFT JOIN ratings USING (rating_id)
				LEFT JOIN sounds USING (sound_id)
				LEFT JOIN formats USING (format_id)
				WHERE dvd_title_id = " . $_GET["dvd_title_id"];

		// Submit SQL
		// Store results to display later 
		$results = $mysqli->query($sql);

		if (!$results) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$details = $results->fetch_assoc();

		// Close connection
		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Details | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item active">Details</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Details</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

		<div class="row mt-4">
			<div class="col-12">

				<div class="text-danger font-italic">
					<?php
						if (isset($error) && !empty($error)) {
							echo $error;
						}
					?>
				</div>

				<table class="table table-responsive">

					<tr>
						<th class="text-right">Title:</th>
						<td><?php echo $details["title"]; ?></td>
					</tr>

					<tr>
						<th class="text-right">Release Date:</th>
						<td><?php echo $details["release_date"]; ?></td>
					</tr>

					<tr>
						<th class="text-right">Genre:</th>
						<td><?php echo $details["genre"]; ?></td>
					</tr>

					<tr>
						<th class="text-right">Label:</th>
						<td><?php echo $details["label"]; ?></td>
					</tr>

					<tr>
						<th class="text-right">Rating:</th>
						<td><?php echo $details["rating"]; ?></td>
					</tr>

					<tr>
						<th class="text-right">Sound:</th>
						<td><?php echo $details["sound"]; ?></td>
					</tr>

					<tr>
						<th class="text-right">Format:</th>
						<td><?php echo $details["format"]; ?></td>
					</tr>

					<tr>
						<th class="text-right">Award:</th>
						<td><?php echo $details["award"]; ?></td>
					</tr>

				</table>


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
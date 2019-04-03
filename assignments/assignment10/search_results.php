<?php
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
				ratings.rating AS rating 
			FROM dvd_titles
			JOIN genres USING (genre_id)
			JOIN ratings USING (rating_id)
			WHERE 1=1";

	if ( isset($_GET["title"]) && !empty($_GET["title"]) ) {
		$sql = $sql . " AND dvd_titles.title LIKE '%" . $_GET["title"] . "%'";
	}
	if ( isset($_GET["genre"]) && !empty($_GET["genre"]) ) {
		$sql = $sql . " AND dvd_titles.genre_id = " . $_GET["genre"];
	}
	if ( isset($_GET["rating"]) && !empty($_GET["rating"]) ) {
		$sql = $sql . " AND dvd_titles.rating_id = " . $_GET["rating"];
	}
	if ( isset($_GET["label"]) && !empty($_GET["label"]) ) {
		$sql = $sql . " AND dvd_titles.label_id = " . $_GET["label"];
	}
	if ( isset($_GET["format"]) && !empty($_GET["format"]) ) {
		$sql = $sql . " AND dvd_titles.format_id = " . $_GET["format"];
	}
	if ( isset($_GET["sound"]) && !empty($_GET["sound"]) ) {
		$sql = $sql . " AND dvd_titles.sound_id = " . $_GET["sound"];
	}

	if ( isset($_GET["award"]) && !empty($_GET["award"]) && $_GET["award"] == "yes" ) {
		$sql = $sql . " AND dvd_titles.award IS NOT NULL";
	} else if ( isset($_GET["award"]) && !empty($_GET["award"]) && $_GET["award"] == "no" ) {
		$sql = $sql . " AND dvd_titles.award IS NULL";
	}

	if ( isset($_GET["release_date_from"]) && !empty($_GET["release_date_from"]) ) {
		$sql = $sql . " AND dvd_titles.release_date IS NOT NULL AND dvd_titles.release_date > " . " STR_TO_DATE('" . $_GET["release_date_from"] . "/01/01', '%Y/%m/%d')";
	}
	if ( isset($_GET["release_date_to"]) && !empty($_GET["release_date_to"]) ) {
		$sql = $sql . " AND dvd_titles.release_date IS NOT NULL AND dvd_titles.release_date < " . " STR_TO_DATE('" . $_GET["release_date_to"] . "/12/31', '%Y/%m/%d')";
	}

	$sql = $sql . " ORDER BY dvd_titles.dvd_title_id;";

	// Submit SQL
	// Store results to display later 
	$results = $mysqli->query($sql);

	if (!$results) {
		echo "SQL Error: " . $mysqli->error;
		exit();
	}

	// Close connection
	$mysqli->close();
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>DVD Search Results</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		th {
			text-align: left;
		}
	</style>
</head>
<body>
	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item active">Results</li>
	</ol>
	<div class="container-fluid">
		<div class="row">
			<h1 class="col-12 mt-4">DVD Search Results</h1>
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
	<div class="container-fluid">
		<div class="row mb-4">
			<div class="col-12 mt-4">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row">
			<div class="col-12">

				Showing <?php echo $results->num_rows; ?> result(s).

			</div> <!-- .col -->
			<div class="col-12">
				<table class="table table-hover table-responsive mt-4">
					<thead>
						<tr>
							<th>DVD Title</th>
							<th>Release Date</th>
							<th>Genre</th>
							<th>Rating</th>
						</tr>
					</thead>
					<tbody>

						<!-- Display results -->
						<?php while ( $row = $results->fetch_assoc() ) : ?>
							<tr>
								<td><?php echo "<a href=\"delete.php?dvd_title_id=" 
												. $row["dvd_title_id"]
												. "\" class=\"btn btn-outline-danger\" 
												onclick=\"return confirm('Are you sure you want to delete this movie?');\">" 
												. "Delete" 
												. "</a>"; ?></td>
								<td><?php echo "<a href=\"details.php?dvd_title_id=" 
												. $row["dvd_title_id"] . "\">" 
												. $row["title"] . "</a>"; ?></td>
								<td><?php echo $row["release_date"]; ?></td>
								<td><?php echo $row["genre"]; ?></td>
								<td><?php echo $row["rating"]; ?></td>
							</tr>
						<?php endwhile; ?>

					</tbody>
				</table>
			</div> <!-- .col -->
		</div> <!-- .row -->
		<div class="row mt-4 mb-4">
			<div class="col-12">
				<a href="search_form.php" role="button" class="btn btn-primary">Back to Form</a>
			</div> <!-- .col -->
		</div> <!-- .row -->
	</div> <!-- .container-fluid -->
</body>
</html>
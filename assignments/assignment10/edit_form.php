<?php
	if( !isset($_GET["dvd_title_id"]) || empty($_GET["dvd_title_id"]) ) 
	{
		// Display a nice looking error message to the user
		$error = "Invalid DVD title ID.";
	} 
	else
	{
		// Establish DB connection
		require("config.php");  // Defines $host, $user, $pass, and $db

		$mysqli = new mysqli($host, $user, $pass, $db);

		if ($mysqli->connect_errno) {
			echo "MySQL Connection Error: " . $mysqli->connect_errno;
			exit();
		}

		// Generate and submit SQL
		// Store results to display later
		$sql = "SELECT * FROM genres";
		$genres = $mysqli->query($sql);

		if (!$genres) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$sql = "SELECT * FROM ratings";
		$ratings = $mysqli->query($sql);

		if (!$ratings) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$sql = "SELECT * FROM labels";
		$labels = $mysqli->query($sql);

		if (!$labels) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$sql = "SELECT * FROM formats";
		$formats = $mysqli->query($sql);

		if (!$formats) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$sql = "SELECT * FROM sounds";
		$sounds = $mysqli->query($sql);

		if (!$sounds) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$sql = "SELECT * FROM dvd_titles
				WHERE dvd_title_id = " . $_GET["dvd_title_id"] . ";";
		$results = $mysqli->query($sql);

		if (!$results) {
			echo "SQL Error: " . $mysqli->error;
			exit();
		}

		$current = $results->fetch_assoc();

		// Close connection
		$mysqli->close();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Edit Form | DVD Database</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
	<style>
		.form-check-label {
			padding-top: calc(.5rem - 1px * 2);
			padding-bottom: calc(.5rem - 1px * 2);
			margin-bottom: 0;
		}
	</style>
</head>
<body>

	<ol class="breadcrumb">
		<li class="breadcrumb-item"><a href="index.php">Home</a></li>
		<li class="breadcrumb-item"><a href="search_form.php">Search</a></li>
		<li class="breadcrumb-item"><a href="search_results.php">Results</a></li>
		<li class="breadcrumb-item"><a href=<?php echo "\"details.php?dvd_title_id=" . $_GET['dvd_title_id'] . "\""; ?>>Details</a></li>
		<li class="breadcrumb-item active">Edit</li>
	</ol>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-4 mb-4">Edit a DVD</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->

	<div class="container">

			<div class="col-12 text-danger">
				<?php
					if (isset($error) && !empty($error)) {
						echo $error;
					}
				?>
			</div>

			<form action="edit_confirmation.php" method="POST">

				<input type="hidden" name="dvd_title_id" value="<?php echo $_GET["dvd_title_id"]; ?>">
				
				<div class="form-group row">
					<label for="title-id" class="col-sm-3 col-form-label text-sm-right">Title: <span class="text-danger">*</span></label>
					<div class="col-sm-9">
						<input type="text" class="form-control" id="title-id" name="title" value=<?php echo "\"" . $current["title"] . "\"" ?>>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="release-date-id" class="col-sm-3 col-form-label text-sm-right">Release Date:</label>
					<div class="col-sm-9">
						<input type="date" class="form-control" id="release-date-id" name="release_date" value=<?php echo "\"" . $current["release_date"] . "\""; ?>>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="label-id" class="col-sm-3 col-form-label text-sm-right">Label:</label>
					<div class="col-sm-9">
						<select name="label" id="label-id" class="form-control">
							<option value="" <?php if (!isset($current["label_id"]) || empty($current["label_id"])) { echo "selected"; } ?>>-- Select One --</option>
							<?php while ($row = $labels->fetch_assoc()) : ?>

								<option value="<?php echo $row["label_id"]; ?>" <?php if ($row["label_id"] == $current["label_id"]) { echo "selected";} ?>><?php echo $row["label"]; ?></option>

							<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="sound-id" class="col-sm-3 col-form-label text-sm-right">Sound:</label>
					<div class="col-sm-9">
						<select name="sound" id="sound-id" class="form-control">
							<option value="" <?php if (!isset($current["sound_id"]) || empty($current["sound_id"])) { echo "selected"; } ?>>-- Select One --</option>
							<?php while ($row = $sounds->fetch_assoc()) : ?>

								<option value="<?php echo $row["sound_id"]; ?>" <?php if ($row["sound_id"] == $current["sound_id"]) { echo "selected";} ?>><?php echo $row["sound"]; ?></option>

							<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="genre-id" class="col-sm-3 col-form-label text-sm-right">Genre:</label>
					<div class="col-sm-9">
						<select name="genre" id="genre-id" class="form-control">
							<option value="" <?php if (!isset($current["genre_id"]) || empty($current["genre_id"])) { echo "selected"; } ?>>-- Select One --</option>
							<?php while ($row = $genres->fetch_assoc()) : ?>

								<option value="<?php echo $row["genre_id"]; ?>" <?php if ($row["genre_id"] == $current["genre_id"]) { echo "selected";} ?>><?php echo $row["genre"]; ?></option>

							<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="rating-id" class="col-sm-3 col-form-label text-sm-right">Rating:</label>
					<div class="col-sm-9">
						<select name="rating" id="rating-id" class="form-control">
							<option value="" <?php if (!isset($current["rating_id"]) || empty($current["rating_id"])) { echo "selected"; } ?>>-- Select One --</option>
							<?php while ($row = $ratings->fetch_assoc()) : ?>

								<option value="<?php echo $row["rating_id"]; ?>" <?php if ($row["rating_id"] == $current["rating_id"]) { echo "selected";} ?>><?php echo $row["rating"]; ?></option>

							<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="format-id" class="col-sm-3 col-form-label text-sm-right">Format:</label>
					<div class="col-sm-9">
						<select name="format" id="format-id" class="form-control">
							<option value="" <?php if (!isset($current["format_id"]) || empty($current["format_id"])) { echo "selected"; } ?>>-- Select One --</option>
							<?php while ($row = $formats->fetch_assoc()) : ?>

								<option value="<?php echo $row["format_id"]; ?>" <?php if ($row["format_id"] == $current["format_id"]) { echo "selected";} ?>><?php echo $row["format"]; ?></option>

							<?php endwhile; ?>
						</select>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<label for="award-id" class="col-sm-3 col-form-label text-sm-right">Award:</label>
					<div class="col-sm-9">
						<textarea name="award" id="award-id" class="form-control"><?php echo $current["award"] ?></textarea>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<div class="ml-auto col-sm-9">
						<span class="text-danger font-italic">* Required</span>
					</div>
				</div> <!-- .form-group -->

				<div class="form-group row">
					<div class="col-sm-3"></div>
					<div class="col-sm-9 mt-2">
						<button type="submit" class="btn btn-primary">Submit</button>
						<button type="reset" class="btn btn-light">Reset</button>
					</div>
				</div> <!-- .form-group -->

			</form>

	</div> <!-- .container -->
</body>
</html>

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

				<div class="text-danger font-italic">Display Errors Here</div>

				<table class="table table-responsive">

					<tr>
						<th class="text-right">Title:</th>
						<td><!-- PHP Output Here --></td>
					</tr>

					<tr>
						<th class="text-right">Release Date:</th>
						<td><!-- PHP Output Here --></td>
					</tr>

					<tr>
						<th class="text-right">Genre:</th>
						<td><!-- PHP Output Here --></td>
					</tr>

					<tr>
						<th class="text-right">Label:</th>
						<td><!-- PHP Output Here --></td>
					</tr>

					<tr>
						<th class="text-right">Rating:</th>
						<td><!-- PHP Output Here --></td>
					</tr>

					<tr>
						<th class="text-right">Sound:</th>
						<td><!-- PHP Output Here --></td>
					</tr>

					<tr>
						<th class="text-right">Format:</th>
						<td><!-- PHP Output Here --></td>
					</tr>

					<tr>
						<th class="text-right">Award:</th>
						<td><!-- PHP Output Here --></td>
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
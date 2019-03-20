<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>

	<div class="container">
		<div class="row">
			<h1 class="col-12 mt-5 mb-3">Registration Form</h1>
		</div> <!-- .row -->
	</div> <!-- .container -->
	
	<div class="container">

		<form action="register.php" method="POST" class="mt-3">

			<div class="form-group row">
				<label for="fname-id" class="col-sm-3 col-form-label text-sm-right">First Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="fname-id" name="fname" placeholder="Tommy">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="lname-id" class="col-sm-3 col-form-label text-sm-right">Last Name:</label>
				<div class="col-sm-9">
					<input type="text" class="form-control" id="lname-id" name="lname" placeholder="Trojan">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="email-id" class="col-sm-3 col-form-label text-sm-right">Email:</label>
				<div class="col-sm-9">
					<input type="email" class="form-control" id="email-id" name="email" placeholder="ttrojan@usc.edu">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="phone-id" class="col-sm-3 col-form-label text-sm-right">Phone:</label>
				<div class="col-sm-9">
					<input type="phone" class="form-control" id="phone-id" name="phone" placeholder="(123) 123-1234">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="gender-id" class="col-sm-3 col-form-label text-sm-right">Gender</label>
				<div class="col-sm-9">
					<select name="gender" id="gender-id" class="form-control">
						<option value="" disabled selected>-- Select One --</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
						<option value="other">Other</option>
						<option value="not-say">Rather not say</option>
					</select>
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="pass-id" class="col-sm-3 col-form-label text-sm-right">Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="pass-id" name="pass">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label for="pass-confirm-id" class="col-sm-3 col-form-label text-sm-right">Confirm Password:</label>
				<div class="col-sm-9">
					<input type="password" class="form-control" id="pass-confirm-id" name="pass-confirm">
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label class="col-sm-3 col-form-label text-sm-right">Verification Method</label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="radio" name="verification-method" class="form-check-input mr-2" value="Email">
							Email
						</label>
					</div> <!-- .form-check -->
					<div class="form-check form-check-inline">
						<label class="form-check-label ml-2">
							<input type="radio" name="verification-method" class="form-check-input mr-2" value="Phone">
							Phone
						</label>
					</div> <!-- .form-check -->
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<label class="col-sm-3"></label>
				<div class="col-sm-9">
					<div class="form-check form-check-inline">
						<label class="form-check-label">
							<input type="checkbox" name="terms-accepted" class="form-check-input mr-2" value="yes">
							I accept terms & conditions.
						</label>
					</div> <!-- .form-check -->
				</div>
			</div> <!-- .form-group -->

			<div class="form-group row">
				<div class="col-sm-3"></div>
				<div class="col-sm-9">
					<button type="submit" class="btn btn-primary">Submit</button>
					<button type="reset" class="btn btn-light">Reset</button>
				</div>
			</div> <!-- .form-group -->

		</form>
		
	</div> <!-- .container -->

</body>
</html>
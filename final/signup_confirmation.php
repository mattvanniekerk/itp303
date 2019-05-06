<?php
session_start();

define('DB_HOST', '303.itpwebdev.com');
define('DB_USER', 'vannieke_db_user');
define('DB_PASS', 'BigHac%1996');
define('DB_NAME', 'vannieke_final_db');

if ( !isset($_POST['username']) || empty($_POST['username'])
	|| !isset($_POST['password']) || empty($_POST['password']) ) {
	$error = "Please fill out all required fields.";
} else {
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    if ($mysqli->connect_errno) {
        echo $mysqli->connect_error;
        exit();
    }

    $sql_registered = "SELECT * FROM users
                        WHERE username = '" . $_POST['username'] . "';";

    $results_registered = $mysqli->query($sql_registered);
    if (!$results_registered) {
        echo $mysqli->error;
        exit();
    }

    if ($results_registered->num_rows > 0) {
        $error = "Username has already been taken. Please choose another one.";
    } else {
        $hashedPassword = hash('sha256', $_POST['password']);

        $sql = "INSERT INTO users(username, password)
                VALUES ('" . $_POST['username'] . "', '" . $hashedPassword . "');";

        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            exit();
        }
    }

    $mysqli->close();
}

?>
<!DOCTYPE html>
<html>
    <head>
        <title>LexiPro</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand" href="login.php"><b>LexiPro</b></a>  
            </div>
        </nav>

        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h1 id="signup-heading">Sign Up</h1>
                </div>
            </div> 

            <div class="row">
                <div class="col-md-4">
                    <?php if ( isset($error) && !empty($error) ) : ?>
                        <p style="color: #B6465F;"><?php echo $error; ?></p>
                    <?php else : ?>
                        <p>Welcome, <?php echo $_POST['username']; ?>! You are now registered.</p>
                    <?php endif; ?>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <a href="login.php" role="button" class="btn btn-outline-primary">Log in</a>
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
    </body>
</html>
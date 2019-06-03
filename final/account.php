<?php
session_start();

require("config.php");  // Defines DB_HOST, DB_USER, DB_PASS, and DB_NAME

if ( isset($_POST['curpassword']) && isset($_POST['newpassword']) ) {
	if ( empty($_POST['curpassword']) || empty($_POST['newpassword']) ) {
	    $error = "Please fill out all required fields.";
    } else {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }

        $passwordInput = hash('sha256', $_POST['curpassword']);

        $sql = "SELECT * FROM users
                WHERE username = '" . $_SESSION['username'] . "' AND password = '" . $passwordInput . "';";

        $results = $mysqli->query($sql);
        if (!$results) {
            echo $mysqli->error;
            exit();
        }

        if ($results->num_rows == 0) {
            $error = "Incorrect password. Please enter it again.";
        } else {
            $hashedPassword = hash('sha256', $_POST['newpassword']);

            $sql = "UPDATE users
                    SET password = '" . $hashedPassword . "' 
                    WHERE username = '" . $_SESSION['username'] . "';";

            $results = $mysqli->query($sql);

            if (!$results) {
                echo $mysqli->error;
                exit();
            }

            $success = "Your password has been changed.";
        }

        $mysqli->close();
    }
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
                <a class="navbar-brand" href="home.php"><b>LexiPro</b></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="my-words.php">My Words</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="about.php">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Sign Out</a>
                        </li>
                    </ul>
                    <form class="form-inline my-2 my-lg-0" action="definition.php" method="GET">
                    <a class="nav-link" href="account.php" id="greeting"><u>Hello, <?php echo $_SESSION['username']; ?>!</u></a>
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" name="word">
                        <button class="btn btn-outline-info my-2 my-sm-0" id="search" type="submit">Search</button>
                    </form>
                    <form class="form-inline my-2 my-lg-0" action="random.php" method="POST">
                        <button class="btn btn-outline-info my-2 my-sm-0" id="random" type="submit">Random</button>
                    </form>
                </div>
            </div>
        </nav>

        <div class="container">
            <form action="account.php" method="POST">
                <div class="form-group row">
                    <div class="col-md-8 flex-item" id="about">
                        <h1>Account</h1>
                        <p>Username: <?php echo $_SESSION['username']; ?></p>
                        <div class="row">
                            <div class="font-italic text-danger col-md-6">
                                <!-- Show errors here. -->
                                <?php
                                    if ( isset($error) && !empty($error) ) {
                                        echo "<p>" . $error . "</p>";
                                    } 
                                ?>
                            </div>
                        </div> <!-- .row -->
                        <div class="row">
                            <div class="font-italic text-success col-md-6">
                                <!-- Show errors here. -->
                                <?php
                                    if ( isset($success) && !empty($success) ) {
                                        echo "<p>" . $success . "</p>";
                                    } 
                                ?>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="password" class="form-control" id="curpassword-id" name="curpassword" placeholder="Current Password">
                                <small id="password-error" class="invalid-feedback">Password is required.</small>
                            </div>
                        </div> 
                        <div class="form-group row">
                            <div class="col-md-4">
                                <input type="password" class="form-control" id="newpassword-id" name="newpassword" placeholder="New Password">
                                <small id="password-error" class="invalid-feedback">Password is required.</small>
                            </div>
                        </div> 
                        <div class="form-group row" id="button-row">
                            <div class="col-md-4">
                                <button type="submit" class="btn btn-outline-primary btn-design" id="change-password-btn">Change Password</button>
                            </div>
                        </div> 
                    </div>
                </div>
            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>

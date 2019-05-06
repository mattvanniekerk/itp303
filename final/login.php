<?php
session_start();

define('DB_HOST', '303.itpwebdev.com');
define('DB_USER', 'vannieke_db_user');
define('DB_PASS', 'BigHac%1996');
define('DB_NAME', 'vannieke_final_db');

if ( isset($_POST['username']) && isset($_POST['password']) ) {
    if ( empty($_POST['username']) || empty($_POST['password']) ) {

        $error = "Please enter username and password.";

    } else {
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($mysqli->connect_errno) {
            echo $mysqli->connect_error;
            exit();
        }

        $passwordInput = hash('sha256', $_POST['password']);

        $sql = "SELECT * FROM users 
                WHERE username = '" . $_POST['username'] . "' AND password = '" . $passwordInput . "';";

        $results = $mysqli->query($sql);

        if (!$results) {
            echo $mysqli->error;
            exit();
        }

        if ($results->num_rows > 0) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $_POST['username'];
            header('Location: home.php');
        } else {
            $error = "Invalid username or password.";
        }
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
                <a class="navbar-brand" href="login.php"><b>LexiPro</b></a>  
            </div>
        </nav>
        <div class="container">
            <form action="login.php" method="POST" id="login-form">
                <div class="row">
                    <div class="col-md-4">
                        <h1 id="login-heading">Log In</h1>
                    </div>
                </div> 
                    
                <div class="row">
                    <div class="font-italic text-danger col-md-4">
                        <!-- Show errors here. -->
                        <?php
                            if ( isset($error) && !empty($error) ) {
                                echo $error;
                            }
                        ?>
                    </div>
                </div> <!-- .row -->

                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="username-id" name="username" placeholder="Username">
                    </div>
                </div>
        
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="password-id" name="password" placeholder="Password">
                    </div>
                </div> 
    
                <!-- error -->
                <div class="row">
                    <div class="col-md-4 font-italic text-danger">
                                        </div>
                </div> 
        
                <div class="form-group row" id="button-row">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-outline-primary btn-design" id="login-btn">Log in</button>
                    </div>
                </div> 

                <div>
                    <p>Don't have an account? <a href="signup.php">Sign up</a></p>
                </div>
    
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
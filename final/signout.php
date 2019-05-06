<?php
session_start();
session_destroy();
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
                    <h1 id="signout-heading">Sign Out</h1>
                    <p>You have signed out.</p>
                    <p><a href="login.php">Log in</a> or <a href="signup.php">sign up</a> to use LexiPro.</p>
                </div>
            </div>
        </div>
    </body>
</html>
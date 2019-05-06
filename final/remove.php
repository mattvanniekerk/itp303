<?php
session_start();

if ( !isset($_GET['word']) || empty($_GET['word']) )
{
    $error = "Invalid word.";
}
else
{
    $host = "303.itpwebdev.com";
    $user = "vannieke_db_user";
    $pass = "BigHac%1996";
    $db = "vannieke_final_db";

    $mysqli = new mysqli($host, $user, $pass, $db);

    if ($mysqli->connect_errno) {
        echo "MySQL Connection Error: " . $mysqli->connect_errno;
        exit();
    }

    $sql = "SELECT user_id FROM users
            WHERE username LIKE '" . $_SESSION['username'] . "';";

    $results = $mysqli->query($sql);

    if (!$results) {
        echo "SQL Error: " . $mysqli->error;
        exit();
    }

    $user_id = ($results->fetch_assoc())["user_id"];

    $sql = "SELECT word_id FROM words
            WHERE word LIKE '" . $_GET['word'] . "';";

    $results = $mysqli->query($sql);

    if (!$results) {
        echo "SQL Error: " . $mysqli->error;
        exit();
    }

    $word_id = ($results->fetch_assoc())["word_id"];



    $sql = "DELETE FROM users_has_words
            WHERE user_id = " . $user_id . " AND word_id = " . $word_id . ";";

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
            <div class="row">
                <div class="col-md-8 flex-item">
                    <h1>Remove Confirmation</h1>
                    <p>You've removed '<?php echo $_GET['word'] ?>' from My Words.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 flex-item">
                    <a href="<?php echo $_SERVER['HTTP_REFERER']; ?>" role="button" class="btn btn-outline-secondary">Back</a>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
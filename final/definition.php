<?php
session_start();

if ( !isset($_GET['word']) || empty($_GET['word']) )
{
    $error = "Invalid word.";
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
            <form action="add_confirmation.php" method="GET">
                <div class="form-group row">
                    <div class="col-md-8 flex-item" id="definition">
                        <?php 
                            if ( isset($error) && !empty($error) ) {
                                echo "<h2>Error</h2>";
                                echo "<p>" . $error . "</p>";
                            }
                        ?>
                        <!-- Definition -->
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-8 flex-item">
                        <button type="submit" class="btn btn-outline-primary" id="add-button" style="visibility:hidden;">Add to My Words</button>
                    </div>
                </div>    
            </form>
        </div>

        <script>
            ajax("https://api.wordnik.com/v4/word.json/<?php echo $_GET['word'] ?>/definitions?api_key=f565787c284a1cb8b30070ffaae05715be178a3d2de45fae9", display);

            function ajax(ep, f) {
                let xhr = new XMLHttpRequest();
                xhr.open("GET", ep);
                xhr.send();
                xhr.onreadystatechange = function() {
                    if (this.readyState == this.DONE) {
                        if (xhr.status == 200) {
                            let resultObjects = JSON.parse(xhr.responseText);
                            f(resultObjects);
                        } else {
                            console.log("AJAX ERROR");
                            console.log(xhr.status);
                        }
                    }
                }
            }

            function display(result) {
                let h2Word = document.createElement("h2");
                document.querySelector("#add-button").setAttribute("name", "word");
                document.querySelector("#definition").appendChild(h2Word);
                
                let divDefinitions = document.createElement("div");
                document.querySelector("#definition").appendChild(divDefinitions);

                let pAttribution = document.createElement("p");
                pAttribution.className = "text-muted attribution-text";
                divDefinitions.appendChild(pAttribution);

                let pWordnik = document.createElement("p");
                pWordnik.className = "text-muted small";
                
                if (result.length == 0) {
                    h2Word.innerHTML = "Not Found";
                    pMessage = document.createElement("p");
                    pMessage.innerHTML = "No entries match '<?php echo $_GET['word']; ?>'. Check the spelling and search again.";  
                    divDefinitions.appendChild(pMessage);
                    
                } else {
                    h2Word.innerHTML = result[0].word;
                    document.querySelector("#add-button").setAttribute("value", result[0].word);
                    pAttribution.innerHTML = result[0].attributionText;   
                    pWordnik.innerHTML = "View on <a target=\"_blank\" href=\"https://www.wordnik.com/words/" + result[0].word + "\">Wordnik</a>.";
                    document.querySelector("#add-button").style.visibility = "visible";
                }

                for (var i = 0; i < result.length; i++) {
                    let pDefinition = document.createElement("p");

                    pDefinition.className = "definition-text";
                    pDefinition.innerHTML = "<em>" + result[i].partOfSpeech + "</em> : ";

                    var words = result[i].text.split(" ");
                    for (var j = 0; j < words.length; j++) {
                        var stripped = words[j].replace(/[.,\/#!$%\^&\*;:{}=\-_`~()'"‘’“”]/g,"");
                        stripped = stripped.toLowerCase();
                        pDefinition.innerHTML += "<a class=\"definition-word\" href=\"definition.php?word=" + stripped + "\">" + words[j] + "</a> ";
                    }
                    
                    divDefinitions.appendChild(pDefinition);
                }

                divDefinitions.appendChild(pWordnik);
            }
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
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
            <form action="signup_confirmation.php" method="POST" id="signup-form">
                <div class="row">
                    <div class="col-md-4">
                        <h1 id="signup-heading">Sign Up</h1>
                    </div>
                </div> 
                    
                <div class="form-group row">
                    <!-- <label for="username-id" class="col-sm-3 col-form-label text-sm-right">Username: <span class="text-danger">*</span></label> -->
                    <div class="col-md-4">
                        <input type="text" class="form-control" id="username-id" name="username" placeholder="Username">
                        <small id="username-error" class="invalid-feedback">Username is required.</small>
                    </div>
                </div>
        
                <div class="form-group row">
                    <div class="col-md-4">
                        <input type="password" class="form-control" id="password-id" name="password" placeholder="Password">
                        <small id="password-error" class="invalid-feedback">Password is required.</small>
                    </div>
                </div> 
    
                <!-- error -->
                <div class="row">
                    <div class="col-md-4 font-italic text-danger">
                    </div>
                </div> 
        
                <div class="form-group row" id="button-row">
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-outline-primary btn-design" id="signup-btn">Sign Up</button>
                    </div>
                </div> 

                <div>
                    <p>Already have an account? <a href="login.php">Log in</a></p>
                </div>
    
            </form>
        </div>

        <script>
            document.querySelector('form').onsubmit = function(){
                if ( document.querySelector('#username-id').value.trim().length == 0 ) {
                    document.querySelector('#username-id').classList.add('is-invalid');
                } else {
                    document.querySelector('#username-id').classList.remove('is-invalid');
                }

                if ( document.querySelector('#password-id').value.trim().length == 0 ) {
                    document.querySelector('#password-id').classList.add('is-invalid');
                } else {
                    document.querySelector('#password-id').classList.remove('is-invalid');
                }

                return ( !document.querySelectorAll('.is-invalid').length > 0 );
            }
        </script>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGN UP</title>
<?php include 'mystyle.php'; 
?>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark">
        <a class="navbar-brand" href="#">My Fake Twitter</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                </li>
            </ul>
    </div>
    <div class="d-flex">
      <a class="nav-link" href="signup.php">Register</a>
      <a class="nav-link" href="login.php">Login</a>
      </div>
    
</nav>



<div class="container" style="padding-top:20px">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card"> 
            <h2 class="card-header text-center">Login User</h2>
            <div class="card-body">
                <form method="POST" action="authenticate.php">

                    <div class="mb-4">
                        <input type="email" class="form-control" name="email" placeholder="Email">
                    </div>

                    <div class="mb-4">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-custom">Login</button>
                    </div>


                <div class="text-center mt-2">
                    <a href="signup.php">No account? Register</a>
                    </div>

                </form>
            </div> 
        </div>
    </div>
</div>

</body>
</html>

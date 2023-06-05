<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Profile</title>
    <?php include 'mystyle.php';?>
    
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark">
    <a class="navbar-brand" href="index.php">My Fake Twitter</a>
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
        <a class="nav-link" href="viewprofile.php">My Profile</a>
        <a class="nav-link" href="logout.php">Logout</a>
    </div>
</nav>

<?php
session_start();
include 'mykeys.php';

$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$userCol = $db->collection('users');
$query = $userCol->documents();

$firstDocument = null;

foreach ($query as $document) {
    $firstDocument = $document;
    break; // Retrieve only the first document
}

if (!$firstDocument) {
    echo "No user found.";
} else {
    $email = $firstDocument['email'];
    $username = $firstDocument['username'];

    echo '<div class="container">
        <div class="row">
            <div class="col-12">
                <!-- Page title -->
                <div class="my-5">
                    <h3>My Profile</h3>
                    <hr>
                </div> 
                
                 <form class="file-upload">
                    <div class="row mb-5 gx-5">
                        <!-- Contact detail -->
                        <div class="col-xxl-8 mb-5 mb-xxl-0">
                            <div class="bg-secondary-soft px-4 py-5 rounded">
                                <div class="row g-3">
                                    <h4 class="mb-2 mt-0">Saved details</h4>
                                    <!-- Email -->
                                    <div class="col-md-6">
                                        <label class="form-label">Email *</label>
                                        <input type="email" class="form-control" placeholder="" aria-label="Email" value="' . $email . '">
                                    </div>
                                    <!-- Password -->
                                    <div class="col-md-6">
                                        <label class="form-label">Username *</label>
                                        <input type="text" class="form-control" placeholder="" aria-label="username" value="' . $username . '">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>';

    echo '
                    <!-- Submit button -->
                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </div>
                </form>
                <!-- Form END -->
            </div>
        </div>
    </div>';
}
?>


</body>
</html>

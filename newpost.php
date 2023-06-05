<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require_once __DIR__ . '/vendor/autoload.php';

use Google\Cloud\Firestore\FirestoreClient;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form inputs
    $title = $_POST['title'];
    $comments = (int)$_POST['comments']; // Convert to integer
    $reaction = (int)$_POST['reaction']; // Convert to integer
    $status = $_POST['status'];
    $description = $_POST['description'];

    // Connect to Firestore
    $db = new FirestoreClient([
        'keyFilePath' => 'keys/php-8-point-1-firebase-adminsdk-2db4s-a7c00f0f4f.json',
        'projectId' => 'php-8-point-1'
    ]);

    // Create a new post
    $newDocId = $db->collection('posts')->add([
        'title' => $title,
        'user_id' => $_SESSION['user_id'],
        'comments' => $comments,
        'reaction' => $reaction,
        'status' => $status,
        'description' => $description
    ])->id();

    // Add a comment to the post
    $db->collection('comments')->add([
        'post_id' => $newDocId,
        'user_id' => $_SESSION['user_id'],
        'comment' => 'awesome'
    ]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
    <?php include 'mystyle.php'; ?>
    <style>
        .navbar {
            background-color: #343a40;
        }

        .navbar-brand, .nav-link {
            color: #fff;
        }

        .navbar-toggler-icon {
            background-color: #fff;
        }

        .card {
            margin-top: 20px;
        }
    </style>
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
        <a class="nav-link" href="signup.php">Register</a>
        <a class="nav-link" href="login.php">Login</a>
    </div>
</nav>

<div class="container" style="padding-top: 20px">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <h2 class="card-header text-center">Create Post</h2>
                <div class="card-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="form-group">
                            <label for="comments">Comments:</label>
                            <input type="number" class="form-control" id="comments" name="comments" required>
                        </div>

                        <div class="form-group">
                            <label for="reaction">Reaction:</label>
                            <input type="number" class="form-control" id="reaction" name="reaction" required>
                        </div>

                        <div class="form-group">
                            <label for="status">Status:</label>
                            <input type="text" class="form-control" id="status" name="status" required>
                        </div>

                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-custom">Create Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>


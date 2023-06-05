<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Fake Twitter</title>
  <?php include 'mystyle.php';?>
</head>
<body>

<?php
use Google\Cloud\Firestore\FirestoreClient;
require_once __DIR__ . '/vendor/autoload.php';

include 'mykeys.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $id = $_GET['id'];

    if (isset($_POST['comment-input'])) {
        $content = $_POST['comment-input'];

        if ($content != "") {
            $post = $db->collection('posts')->document($id)->snapshot();
            $db->collection('comments')->add([
                'post-id' => $id,
                'user' => "Guest_User",
                'content' => $content
            ]);
            $db->collection('posts')->document($id)->set([
                'comments' => $post->get('comments')+1
            ], ['merge' => true]);

            echo "Added Comment!";
            header("Location: comment.php?id=".$id);
            exit();
        } else {
            echo "Empty!";
        }
    }

    if (isset($_POST['delete-comment'])) {
        $commentId = $_POST['delete-comment'];
        $db->collection('comments')->document($commentId)->delete();
        $post = $db->collection('posts')->document($id)->snapshot();
        $db->collection('posts')->document($id)->set([
            'comments' => $post->get('comments')-1
        ], ['merge' => true]);

        echo "Deleted Comment!";
        header("Location: comment.php?id=".$id);
        exit();
    }
}

$id = $_GET['id'];
$post = $db->collection('posts')->document($id)->snapshot();
if (!$post->exists()) {
    echo "Post not found.";
    exit();
}

$commentsRef = $db->collection('comments')->where('post-id', '=', $id)->documents();
$comments = [];
foreach ($commentsRef as $comment) {
    $commentData = $comment->data();
    $commentData['comment-id'] = $comment->id();
    $comments[] = $commentData;
}
?>


<nav class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="index.php">My Fake Twitter</a>
      <ul class="navbar-nav ml-auto">
        <?php
        session_start();
        if (isset($_SESSION['user_id'])) {
          echo '<li class="nav-item">
                  <a class="nav-link" href="logout.php">Logout</a>
                </li>';
        } else {
          echo '<li class="nav-item">
                  <a class="nav-link" href="signup.php">Register</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="login.php">Login</a>
                </li>';
        }
        ?>
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-5">
  <div class="card">
    <div class="card-header">
      Post Title: <?php echo $post['title']; ?>
    </div>
    <div class="card-body">
      <p class="card-text">Post Description: <?php echo $post['description']; ?></p>
      <p class="card-text">Reactions: <?php echo $post['reaction']; ?></p>
      <p class="card-text">Comments: <?php echo $post['comments']; ?></p>
    </div>
  </div>

  <form action="" method="POST">
    <div class="form-group mt-4">
      <textarea class="form-control comment-input" id="comment-input" name="comment-input" rows="3" placeholder="Write a comment..."></textarea>
    </div>
    <button type="submit" class="btn btn-primary comment-submit-btn">Submit</button>
  </form>

  <div class="card mt-4">
    <div class="card-body">
      <h3 class="card-header">Comments</h3>
      <hr class="comment-separator"> 
      <?php if (empty($comments)) { ?>
        <p class="card-text">Sadly, no comments yet.</p>
      <?php } else { 
        foreach ($comments as $comment) { ?>
          <div class="card comment-card mt-3">
            <div class="card-body">
              <h5 class="card-title"><?php echo $comment['user']; ?></h5>
              <p class="card-text"><?php echo $comment['content']; ?></p>
              <?php if (isset($_SESSION['user_id'])) { ?>
                <form action="delete_comment.php" method="POST" class="d-inline">
                  <input type="hidden" name="delete-comment" value="<?php echo $comment['comment-id']; ?>">
                  <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
              <?php } ?>
            </div>
          </div>
          <hr class="comment-separator"> 
        <?php }
      } ?>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

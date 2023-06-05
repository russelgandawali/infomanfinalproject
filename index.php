<?php session_start();
include 'mykeys.php';?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Fake Twitter</title>
  <?php include 'mystyle.php';?>
  

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  
    <a class="navbar-brand" href="index.php">My Fake Twitter</a>
    
              

    <?php
    if (isset($_SESSION['user_id'])) {
      echo '
              <div class="navbar-nav me-auto mb-2 mb-lg-0">
              <a class="nav-link" href="newpost.php">Add New Post</a></div>
              <a class="nav-link" href="viewprofile.php">My Profile</a>
              <a class="nav-link" href="logout.php">Logout</a>
              
            ';
      echo '<div class="d-flex align-items-center">
              <a class="link-secondary me-3" href="#">
                <i class="fas fa-shopping-cart"></i>
              </a>
              <div class="dropdown">
                <a class="link-secondary me-3 dropdown-toggle hidden-arrow" href="#" id="navbarDropdownMenuLink" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-bell"></i>
                  <span class="badge rounded-pill badge-notification bg-danger">1</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                  <li>
                    <a class="dropdown-item" href="#">Some news</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Another news</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Something else here</a>
                  </li>
                </ul>
              </div>
              <div class="dropdown">
                <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="navbarDropdownMenuAvatar" role="button" data-mdb-toggle="dropdown" aria-expanded="false">
                  <img src="https://mdbcdn.b-cdn.net/img/new/avatars/2.webp" class="rounded-circle" height="25" alt="Black and White Portrait of a Man" loading="lazy">
                  <span class="ms-2">' . (isset($_SESSION['username']) ? $_SESSION['username'] : '') . '</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuAvatar">
                  <li>
                    <a class="dropdown-item" href="#">My profile</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="#">Settings</a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                  </li>
                </ul>
              </div>
            </div>';
    } else {
      echo '<div class="d-flex">';
      echo '<a class="nav-link" href="signup.php">Register</a>';
      echo '<a class="nav-link" href="login.php">Login</a>';
      echo '</div>';
    }
    ?>
</nav>


  <div class="container my-4">
    <div class="row justify-content-center">
      <div class="col-8">
        <form>
          <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search">
            <button class="btn btn-outline-primary">Search</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <?php
  

  $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
  
  $postCol = $db->collection('posts');
  $posts = $postCol->documents();
  $search = isset($_GET['search']) ? $_GET['search'] : "";
  $filtered = array();
  
  foreach ($posts as $post) {
      $postc = strtolower($post['title']);
      $searchc = strtolower($search);
      if (strpos($postc, $searchc) !== false) {
          $filtered[] = $post;
      }
  }
  
  if (empty($filtered)) {
      echo "No results found.";
  } else {
      foreach ($filtered as $post) {
          echo '<div class="container mb-4">
                  <div class="card">
                    <h5 class="card-header">Post Title: ' . $post['title'] . '</h5>
                    <div class="card-body">
                      <p class="card-text">Post description: ' . $post['description'] . '</h5>
                      <p class="card-text">Reactions: ' . $post['reaction'] . '</p>
                      <div class="rounded bg-light px-3 py-2">
                      <a href="comment.php?id=' . $post->id() . '" class="btn btn-link custom-link">Comments: ' . $post['comments'] . '</a>';
  
          $likedClass = $user_id && isset($post['likes'][$user_id]) && $post['likes'][$user_id] ? "btn btn-danger float-end" : "btn btn-outline-danger float-end";
  
          echo '<a href="increment.php?id=' . $post->id() . '" class="' . $likedClass . '"><i class="bi bi-hand-thumbs-up"></i></a>
              </div>
            </div>
          </div>
        </div>';
      }
  }
  ?>

</body>
</html>

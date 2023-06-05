<?php 
//putenv("FIREBASE_AUTH_EMULATOR_HOST=localhost:9099"); //connect to local emulator
//putenv("FIRESTORE_EMULATOR_HOST=localhost:8080"); //connect to local emulator

include 'mykeys.php';

$post_id = $_GET['id'];

session_start();
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

$postCol = $db->collection('posts');
$postRef = $postCol->document($post_id);
$post = $postRef->snapshot();

if ($post->exists()) {
    $reaction = $post['reaction'];
    $likes = isset($post['likes']) ? $post['likes'] : [];

    $hasLiked = isset($likes[$user_id]) && $likes[$user_id];

    if ($hasLiked) {
        $reaction--;
        unset($likes[$user_id]);
    } else {
        $reaction++;
        $likes[$user_id] = true;
    }

    $postRef->set([
        'reaction' => $reaction,
        'likes' => $likes
    ], ['merge' => true]);

    header('Location: index.php');
    exit;
} else {
    header('Location: error.php');
    exit;
}
?>

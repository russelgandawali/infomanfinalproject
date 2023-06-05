<?php
use Google\Cloud\Firestore\FieldValue;
use Google\Cloud\Firestore\FirestoreClient;
require_once __DIR__ . '/vendor/autoload.php';

include 'mykeys.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['delete-comment'])) {
        $commentId = $_POST['delete-comment'];
        $commentRef = $db->collection('comments')->document($commentId);
        $commentData = $commentRef->snapshot()->data();
        $postId = $commentData['post-id'];

        $commentRef->delete();
        $postRef = $db->collection('posts')->document($postId);
        $postRef->set([
            'comments' => FieldValue::increment(-1)
        ], ['merge' => true]);

        header("Location: comment.php?id=".$postId);
        exit();
    }
}
?>

<?php 
//putenv("FIREBASE_AUTH_EMULATOR_HOST=localhost:9099"); //connect to local emulator
//putenv("FIRESTORE_EMULATOR_HOST=localhost:8080"); //connect to local emulator
require_once __DIR__.'/vendor/autoload.php';
use Google\Cloud\Firestore\FirestoreClient;
$db = new FirestoreClient([
      'keyFilePath' => 'keys/php-8-point-1-firebase-adminsdk-2db4s-a7c00f0f4f.json',
      'projectId' => 'php-8-point-1'
  ]); ?>
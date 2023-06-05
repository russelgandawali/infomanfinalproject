<?php
//putenv("FIREBASE_AUTH_EMULATOR_HOST=localhost:9099"); //connect to local emulator
//putenv("FIRESTORE_EMULATOR_HOST=localhost:8080"); //connect to local emulator

session_start();
use Kreait\Firebase\Factory;
use Kreait\Firebase\Exception\Auth\UserNotFound;
use Kreait\Firebase\Exception\Auth\InvalidPassword;
require_once __DIR__. '/vendor/autoload.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$password = $_POST['password'];
$email = $_POST['email'];

$factory = (new Factory)->withServiceAccount('keys/php-8-point-1-firebase-adminsdk-2db4s-a7c00f0f4f.json');
$auth = $factory->createAuth();

try{
$attemptSignIn = $auth->signInWithEmailAndPassword($email,$password);
$_SESSION['user_id'] = $attemptSignIn->firebaseUserId();
$_SESSION['email'] = $email;
header('location:index.php');

}catch(InvalidPassword $e){
echo "invalid crediantials";

}catch(UserNotFound $e){
echo "invalid creds";

}catch(Exception $e){
echo "error:" . $e->getMessage();
}

}else{
header('location: login.php');
}
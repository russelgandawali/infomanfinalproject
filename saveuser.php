<?php
//putenv("FIREBASE_AUTH_EMULATOR_HOST=localhost:9099"); //connect to local emulator
//putenv("FIRESTORE_EMULATOR_HOST=localhost:8080"); //connect to local emulator
require_once __DIR__.'/vendor/autoload.php';
use Kreait\Firebase\Exception\Auth\EmailExists;
use Kreait\Firebase\Factory;

if ($_SERVER['REQUEST_METHOD'] === 'POST'){
$username = $_POST['username'];
$password = $_POST['password'];
$email = $_POST['email'];
$userProps = [
	'email' => $email,
	'password' => $password
];
$factory = (new Factory)->withServiceAccount('keys/php-8-point-1-firebase-adminsdk-2db4s-a7c00f0f4f.json');
$auth = $factory->createAuth();

try{
$user=$auth->createUser($userProps); // create user in firebase
$firestore = $factory->createFirestore();
$firestore->database()->collection('users')->document($user->uid)->set([
'email' => $email,
'username' =>$username,
//additional fields like firstname, lastname
]);
header('location:login.php');

}catch(EmailExists $e){
echo "email alrdy exist";
}catch(Exception $e){
echo "error:".$e->getMessage();
}

}else{
header('location: login.php');
}
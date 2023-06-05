<?php 
session_start();
if(!isset($_SESSION['user_id'])){
header('Location: login.php');
exit();
}
session_unset(); //clear all session variables
session_destroy(); // destroy the session
header('location:login.php');

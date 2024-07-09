<?php 
session_start();
require_once __DIR__.'/../helpers/helper.php';

//get user
$token=sanitize($_GET("token"));

//Check if token exists
$user=findUserByFeedbackToken($token);
if($user==null)
{
  header("Location:./index.php");
  exit();
}



?>
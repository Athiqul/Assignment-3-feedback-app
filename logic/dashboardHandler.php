<?php 
session_start();
if(!isset($_SESSION['user']))
{
   header('Location:/login');
}
require_once __DIR__.'/../helpers/helper.php';

//Fetch All feedback Messages
$feedbacks=loadUserFeedbackData($_SESSION['user']['feedback_token']);
//dd($feedbacks);

?>
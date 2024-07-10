<?php 
session_start();
require_once __DIR__.'/../helpers/helper.php';

//Extract token
$requestToken=explode('/',$_SERVER['REQUEST_URI'])[2];


//Check if token exists
$user=findUserByFeedbackToken($requestToken);
if($user==null)
{
  header("Location:./index.php");
  exit();
}




if($_SERVER['REQUEST_METHOD']=='POST')
{
  
  //For Error Messages
  $errors=[];
  if(empty($_POST['feedback']))
  {
    $errors['feedback']="Please provide a feedback!";
  }



  //Sanitize the data
  $feedback = sanitize($_POST['feedback']);


  //Set Min characters
  if(strlen($feedback)<10)
  {
    $errors['feedback']="Feedback should be at least 10 characters!";
  }
  //Check valid feedback length
  if(strlen($feedback)>500)
  {
    $errors['feedback']="Feedback should not exceed 500 characters!";
  }

    
  

  if(empty($errors))
  {
    
     $data=[
      "user_token"=>$user['feedback_token'],
      "feedback"=>$feedback,
      "created_at"=>date('Y-m-d H:i:s'),
      "updated_at"=>date('Y-m-d H:i:s'),
     ];

     //Save feedback to database
     saveFeedback($data);
     header("Location:/feedback-success");
     exit();
  }else {
    flashMessage('error', $errors);
    header("Location:/feedback/".$user['feedback_token']);
    exit();
  }
  
}


?>
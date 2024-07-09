<?php 
require_once __DIR__.'/../helpers/helper.php';
session_start();
//Check this request is post
if($_SERVER['REQUEST_METHOD']=='POST')
{
    //For Error Messages
    $errors=[];
    if(empty($_POST['name']))
    {
        $errors['name']="Please provide a name!";
    }
    if(empty($_POST['email']))
    {
        $errors['email']="Please provide an email!";
    }
    if(empty($_POST['password']))
    {
        $errors['password']="Please provide a password!";
    }
    if(empty($_POST['confirm_password']) )
    {
        $errors['confirm_password']="Please confirm your password!";
    }
    //Sanitize the data
    $name = sanitize($_POST['name']);
    $email = sanitize($_POST['email']);
    $password= sanitize($_POST['password']);
    $confirm_password= sanitize($_POST['confirm_password']);

    //Check valid email
    if(!sanitizeEmail($email))
    {
        $errors['email']="Invalid email! please provide valid email!";
    }

    //Check password match and lenght
    if($password!=$confirm_password)
    {
        $errors['confirm_password']="Passwords do not match with confirm password field!";
    }

    if(strlen($password)<6)
    {
        $errors['password']="Password must be at least 8 characters long and maximum 50 characters long!";
    }




    //Check email already exist 

    //Create account 
    //dd($errors);
    if(empty($errors))
    {
        $data=[
            'name'=>$name,
            'email'=>$email,
            'password'=>password_hash($password, PASSWORD_DEFAULT),
            'feedback_token'=>createFeedbackToken(),
            'created_at'=>date('Y-m-d H:i:s'),
            'updated_at'=>date('Y-m-d H:i:s'),
        ];

        $users=loadUserData();
     // dd($users);
        $users[]=$data;
        saveUserData($users);

        flashMessage('success','Successfully account created! Now you can login');

        header('Location:login.php');
    }else{
        flashMessage('error','You missed something! please try again!');
    }
    

     




}


?>
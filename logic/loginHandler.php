<?php 
require_once __DIR__.'/../helpers/helper.php';
session_start();
//dd($_SERVER);

//Check this request is post
if($_SERVER['REQUEST_METHOD']=='POST')
{
    //For Error Messages
    $errors=[];
   
    if(empty($_POST['email']))
    {
        $errors['email']="Please provide an email!";
    }
    if(empty($_POST['password']))
    {
        $errors['password']="Please provide a password!";
    }
   
    //Sanitize the data
   
    $email = sanitize($_POST['email']);
    $password= sanitize($_POST['password']);
    

    //Check valid email
    if(!sanitizeEmail($email))
    {
        $errors['email']="Invalid email! please provide valid email!";
    }



    
    if(empty($errors))
    {
       
        //check email exist in our filesystem
        $user=findUserByEmail($email);
       // dd($user);

        if($user)
        {
            //Check password match
            if(password_verify($password,$user['password']))
            {
                //Login successfully
                $_SESSION['user'] = $user;
                flashMessage('success','Login successfully!');
                header('Location:dashboard.php');
            }
            else{
                flashMessage('error','invalid email or password!');
            }
        }else{
            flashMessage('error','invalid email or password!');
        }

      

       
    }else{
        flashMessage('error','You missed something! please try again!');
    }
    

     




}


?>
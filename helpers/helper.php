<?php 


//Sanitize input parameters
function sanitize ($value):string
{ 
     return htmlspecialchars( stripslashes(trim($value))); 
}

//Email sanitize
    function sanitizeEmail($email):string
    {
        return filter_var($email, FILTER_SANITIZE_EMAIL);
    }

//Password sanitize
//Set Flash Message and destory

function flashMessage($key,$message='')
{
   
    if(!empty($message))
    {
        $_SESSION['flash'][$key] = $message;
    }else if(isset($_SESSION['flash'][$key]))
    {
        //Store message from session
        $message=$_SESSION['flash'][$key];
        unset($_SESSION['flash'][$key]);
        return $message;
    }

}

//String length handling

function strLength($str,$min=3,$max=50):bool
{
    return (strlen($str) >= $min && strlen($str) <= $max)?true:false;
}

//Create dd function
function dd($data)
{
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die();
}

//Load user data from files json file

function loadUserData()
{
    $usersJson=__DIR__.'/../files/users.json';
    if(!file_exists($usersJson))
    {
        return [];
    }

    $jsonData = file_get_contents($usersJson);
    if(json_last_error()!==JSON_ERROR_NONE)
    {
        return [];
    }
   // dd(json_decode($jsonData, true));
    return json_decode($jsonData, true);
}

//Save user data to json file

function saveUserData($userData)
{
    //Remove existing user data
    if(file_exists(__DIR__.'/../files/users.json'))
    {
        unlink(__DIR__.'/../files/users.json');
    }
    $jsonData=json_encode($userData, JSON_PRETTY_PRINT);
    file_put_contents(__DIR__.'/../files/users.json', $jsonData);
}


//User Feedback token createtion
function createFeedbackToken()
{
    return bin2hex(random_bytes(4));
}

//find user by email

function findUserByEmail($email)
{
    $userData=loadUserData();
   // dd($userData);
    foreach($userData as $user)
    {
        if($user['email'] === $email)
        {
            return $user;
        }
    }
    return null;
}

//Find user by feedback token

function findUserByFeedbackToken($token)
{
    $userData=loadUserData();
    foreach($userData as $user)
    {
        if($user['feedback_token'] === $token)
        {
            return $user;
        }
    }
    return null;
}



?>
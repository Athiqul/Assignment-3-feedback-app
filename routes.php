<?php 
require_once __DIR__ .'/helpers/helper.php';
//Check request uri
$requestUri=$_SERVER['REQUEST_URI'];
//dd($requestUri);
if($requestUri=='/')
{
    require_once __DIR__.'/views/home.php';
}else if($requestUri=='/login')
{
    require_once __DIR__.'/views/login.php';
}else if($requestUri=='/register')
{
    require_once __DIR__.'/views/register.php';
}else if($requestUri=='/dashboard')
{
    require_once __DIR__.'/views/dashboard.php';
}else if(preg_match('/^\/feedback\/.*/',$requestUri,$matches))
{
    $feedbackId=str_replace('/feedback/','',$matches[0]);
    require_once __DIR__.'/views/feedback.php';
}else if($requestUri=='/feedback-success')
{
    require_once __DIR__.'/views/feedback-success.php';
}else {
    http_response_code(404);
    require_once __DIR__.'/views/404.php';
    exit();
}

?>
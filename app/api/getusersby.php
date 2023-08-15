<?php
 require_once("../../vendor/autoload.php");
use App\Controllers\Error;
use App\Controllers\UserController;
use App\Controllers\Response;
if ($_SERVER['REQUEST_METHOD']==="POST") {
    $userCont = new UserController();
    $result = $userCont->getBy(htmlspecialchars($_GET['column']),htmlspecialchars($_GET['value']));
    $response = new Response(200,$result);
    $response->create();
    
    


} else{
    $err = new Error(405);
    $err->create();

 }
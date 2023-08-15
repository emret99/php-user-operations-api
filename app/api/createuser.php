<?php

require_once("../../vendor/autoload.php");
use App\Controllers\Error;
use App\Controllers\Response;
use App\Controllers\UserController;
use App\Models\User;

if ($_SERVER['REQUEST_METHOD']==="POST") {
    $user = new User($_GET['firstname'],$_GET['lastname'],$_GET['address'],$_GET['city'],$_GET['username'],$_GET['password'],);
    $userCont = new UserController();
    $success= $userCont->register($user);
    if ($success) {
        var_dump($success);
        $response = new Response(201,$user);
        $response->create();
        return;
    }
    else{

        $err = new Response(400,[],"User already exists !");
        $err->create();    
     }
    
    
    
    

} else{

    $err = new Error(405);
    $err->create();    
 }



?>
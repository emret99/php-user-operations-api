<?php

require_once("../../vendor/autoload.php");
use App\Controllers\Error;
use App\Controllers\Response;
use App\Controllers\UserController;
 if ($_SERVER['REQUEST_METHOD']=='GET') {

    $userController = new UserController();
    $response = new Response(200,$userController->getAll());
    $response->create();
 }
 else{
   $err = new Error(405);
   $err->create();}

?>
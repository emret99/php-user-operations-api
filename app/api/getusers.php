<?php

require_once("../../vendor/autoload.php");
use App\Controllers\Error;
use App\Controllers\Response;
use App\Controllers\UserController;
use App\Models\Request;
 if ($_SERVER['REQUEST_METHOD']=='GET') {
    $req = new Request($_SERVER);
    $userController = new UserController();
    $response = new Response(200,$userController->getAll());
    $response->create();

 }
 else{
   $err = new Error(405);
   $err->create();}

?>
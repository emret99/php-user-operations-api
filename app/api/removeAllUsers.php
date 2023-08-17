<?php

require_once("../../vendor/autoload.php");

use App\Controllers\Error;
use App\Controllers\Response;
use App\Controllers\UserController;

 if ($_SERVER['REQUEST_METHOD']=='GET') {

    $userCont = new UserController();
    $success = $userCont->removeAll();
    if ($success) {
        $response = new Response(201,[],"Delete all users");
        $response->create();

    }else{
      $err = new Response(400,[],"User doesn't exists");
      $err->create();
    }
 }
 else{
   $err = new Error(405);
   $err->create();}

?>
<?php
 require_once("../../vendor/autoload.php");
use App\Models\User;
use App\Controllers\Error;
use App\Controllers\UserController;
use App\Controllers\Response;
if ($_SERVER['REQUEST_METHOD']==="POST") {
    $user = new User("","","","",$_GET["username"],$_GET["password"]);
    $userCont = new UserController();
    if (!($userCont->login($user))) {
        $err = new Error(400);
        $err->create();
        return;

    }
    $response = new Response(200,$userCont->login($user));
    $response->create();

} else{
    $err = new Error(405);
    $err->create();

 }
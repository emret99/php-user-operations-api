<?php
require_once("../../vendor/autoload.php");
use App\Controllers\Error;
use App\Controllers\Response;
use App\Controllers\UserController;
use App\Models\User;
 if ($_SERVER['REQUEST_METHOD']=='POST') {

    $userCont = new UserController();
    $user = new User($_GET['username'],"","","","","");
    $success = $userCont->remove($user);
    if ($success) {
        $response = new Response(201,$user->username);
        $response->create();

    }else{
   $err = new Error(405);
   $err->create();}
 }
 else{
   $err = new Error(405);
   $err->create();}

?>
<?php

require_once("../../vendor/autoload.php");
use App\Controllers\Error;
use App\Controllers\Response;
use App\Controllers\UserController;
use App\Models\User;
use App\Models\Request;
 if ($_SERVER['REQUEST_METHOD']=='GET') {
    $faker = \Faker\Factory::create("tr_Tr");
    $userCont = new UserController();
    
    if (isset($_GET['userCount'])) {
        
        $success = null ;
        for ($i=0; $i <$_GET['userCount'] ; $i++) { 
            $user = new User($faker->firstName(),$faker->lastName(),$faker->address(),$faker->city(),$faker->userName(),$faker->password());
            $success= $userCont->register($user);
        }
        if ($success) {
            $response = new Response(200,[], $_GET['userCount'] ." user created");
            $response->create();

        }
        else{
            $response = new Response(400,[]);
            $response->create();
        }
    }
    else{
        $user = new User($faker->firstName(),$faker->lastName(),$faker->address(),$faker->city(),$faker->userName(),$faker->password());
        $success= $userCont->register($user);
        if ($success) {
            $response = new Response(200,$user,"User created");
            $response->create();

        }
        else{
            $response = new Response(400,[]);
            $response->create();
        }
    }


 }
 else{

 }


?>
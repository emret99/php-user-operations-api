<?php

namespace App\Controllers;

use App\Controllers\UserController;
use App\Controllers\Error;
class RequestController{
    public array $routes=[
        "/php-user-operations-api/app/api/createfakeuser.php"=>["GET","createFakeUser"],
        "/php-user-operations-api/app/api/createuser.php"=>["POST","register"],
        "/php-user-operations-api/app/api/getusers.php"=>["GET","getAll"],
        "/php-user-operations-api/app/api/login.php"=>["GET","login"],
        "/php-user-operations-api/app/api/removeAllUsers.php"=>["GET","removeAll"],
        "/php-user-operations-api/app/api/removeuser.php"=>["POST","remove"],
        "/php-user-operations-api/app/api/getusersby.php"=>["POST","getBy"],
        "/php-user-operations-api/app/api/changepassword.php"=>["POST","changePassword"],
        
    ];


    public function __construct(
         public array $configs,

         )
         {

            
        }

    public function answer(){
        $user = new UserController();
        //sanitazition of query params from url
        if ($this->configs['QUERY_STRING']) {
            $req  = str_replace("?".$this->configs['QUERY_STRING'],"",$this->configs['REQUEST_URI']);
            //checkling if request method is valid
            if (!($this->configs['REQUEST_METHOD']===$this->routes[$req][0])) {
               $err = new ResponseController(400,"This method is not allowed for this endpoint");
               return $err->create();
            }
            $func = $this->routes[$req][1];
            return $user->$func($_GET);
        }
        else{
            $func = $this->routes[$this->configs['REQUEST_URI']][1];
            return $user->$func();
        }
        


    }
}
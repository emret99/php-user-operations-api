<?php

namespace App\Controllers;



class Request{

    public string $method =$this->configs['REQUEST_METHOD'];

    public function __construct(
         public array $configs,

         )
         {
            

            
        

    }
}
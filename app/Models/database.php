<?php

declare(strict_types=1);
namespace App\Models;

class Database{

    
    public array $config = 
    ["dsn"=>"mysql:host=localhost:3306;",
    "dbname"=>"dbname=test;",
    "username"=>"root",
    "password"=>""
    ];

    public static array $columns= [
        "firstname"=>"firstName",
        "lastname"=>"lastName",
        "address"=>"address",
        "city"=>"city",
        "username"=>"username",
        "password"=>"password"
    ];

    public \PDO $connection;

    public function __construct(

    ){
        try {
            $this->connection = new \PDO($this->config["dsn"].$this->config["dbname"],$this->config["username"],$this->config["password"]);

        } catch (\Throwable $e) {
            echo "  Database has an error : <hr>".$e." <hr>";
            exit;

        }
        
    }
    


}
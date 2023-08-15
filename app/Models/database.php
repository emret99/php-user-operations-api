<?php

declare(strict_types=1);
namespace App\Models;

class Database{

    public string $dbname = 'dbname=test;';
    public string $host= 'mysql:host=localhost:3306;';
    public string $username = 'root';

    public string $password = '';

    public \PDO $connection;

    public function __construct(

    ){
        try {
            $this->connection = new \PDO($this->host.$this->dbname,$this->username,$this->password);

        } catch (\Throwable $e) {
            echo "  Database has an error : <hr>".$e." <hr>";

        }

    }
    


}
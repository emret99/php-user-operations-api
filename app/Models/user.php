<?php


namespace App\Models;


class User {
    public static string $userTable = "users";
    public static array $columns= [
        "firstname"=>"firstName",
        "lastname"=>"lastName",
        "address"=>"address",
        "city"=>"city",
        "username"=>"username",
        "password"=>"password",
        "email"=>"email",
        "created_at"=>"created_at"
    ];

    public function __construct(
        public string $firstName="",
        public string $lastName="",
        public string $address="",
        public string $city="",
        public string $username="",
        public string $password="",
        public string $email="",
        public string $created_at=""
    ){


    }


}
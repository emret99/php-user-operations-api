<?php


namespace App\Models;


class User {
    public static string $userTable = "kullanici";
    public static array $userConfig =["firstname"=>"FirstName","lastname"=>"Lastname","address"=>"Address","city"=>"city","username"=>"k_adi","password"=>"sifre",];


    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $address,
        public string $city,
        public string $username,
        public string $password
    ){


    }

}
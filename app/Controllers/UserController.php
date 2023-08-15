<?php

namespace App\Controllers;

use App\Helpers\ReplaceWord;
use App\Models\User;
use App\Models\Database;
use App\Helpers;
class UserController{

    private Database  $db ;


    public function __construct(
    ){
        $this->db = new Database();
    }

    private static function sanitizeUser(User $user){
        foreach ($user as $key => $value) {
            $user->$key = ReplaceWord::replace($value);
        }
        return $user;
    }



    public  function getAll(){


       return $this->db->connection->query("SELECT * FROM " .User::$userTable  .  ";",\PDO::FETCH_ASSOC)->fetchAll();
    }


    public  function login(User $usr){

         $user = self::sanitizeUser($usr);
         $stmt = $this->db->connection->
         prepare("SELECT * FROM ". User::$userTable ."  WHERE k_adi = :username AND sifre = :password");
         $stmt->execute(array("username"=>$user->username,"password"=>$user->password));
         return $stmt->fetchAll();
         
    }


    public  function getBy($column,$value){

        $query = " SELECT * FROM ". User::$userTable . " WHERE ". $column . " = :value";
        
        $stmt =  $this->db->connection->prepare($query);

        $stmt->execute(["value"=>$value]);

        return $stmt->fetchAll();
        

    }


    public  function register(User $user){

        $userArr= $this->getAll();

        foreach ($userArr as $item) {

            if ($item['k_adi'] === $user->username) {
                return false;
            }          
        }

        $query = "INSERT INTO ". User::$userTable ."(FirstName,LastName,Address,City,k_adi,sifre)
        VALUES (?,?,?,?,?,?);
        ";

        return $this->db->connection->
        prepare($query)->
        execute(array($user->firstName,$user->lastName,$user->address,$user->city,$user->username,$user->password));

    }




    public function remove(User $user){

        $query = "DELETE FROM ". User::$userTable ." WHERE k_adi=:username";

        return $this->db->connection->prepare($query)->execute(array("username"=>$user->firstName));

    }
}
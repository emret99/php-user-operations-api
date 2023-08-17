<?php

namespace App\Controllers;

use App\Helpers\ReplaceWord;
use App\Models\User;
use App\Models\Database;
use App\Exceptions\DatabaseException;
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


         try{      
         return $this->db->connection->query("SELECT * FROM " .User::$userTable  .  ";",\PDO::FETCH_ASSOC)->fetchAll();
        } 
        catch(DatabaseException $e){

        } 

 
    }


    public  function login(User $usr){

         $user = self::sanitizeUser($usr);

         $stmt = $this->db->connection->
         prepare("SELECT * FROM ". User::$userTable ."  WHERE ".User::$columns['username']." = :username AND ".User::$columns['password']." = :password");

         $stmt->execute(array("username"=>$user->username,"password"=>$user->password));

         return $stmt->fetchAll();
         
    }


    public  function getBy($column,$value){
        if (!(array_key_exists($column,User::$columns))) {
            return [];
        }

        $query = " SELECT * FROM ". User::$userTable . " WHERE ". $column . " = :value";
        
        $stmt =  $this->db->connection->prepare($query);

        $stmt->execute(["value"=>$value]);

        return $stmt->fetchAll();
        

    }


    public  function register(User $user){

        $userArr= $this->getAll();

        foreach ($userArr as $item) {
            

            if ($item['username'] === $user->username) {
                return false;
            }  
                
        }

        $query = "INSERT INTO ". User::$userTable ."(".implode(',',User::$columns).")
        VALUES (?,?,?,?,?,?);
        ";

        return $this->db->connection->
        prepare($query)->
        execute(array($user->firstName,$user->lastName,$user->address,$user->city,$user->username,$user->password));


    }




    public function remove(User $user){
       $res = $this->getBy('username',$user->username);
       if (!$res) {
            
            return false;
       }
            $query = "DELETE FROM ". User::$userTable ." WHERE username=:username;";

            return $this->db->connection->prepare($query)->execute(array("username"=>$user->username));                
    }

    public function removeAll(){
        $query = "TRUNCATE TABLE " . User::$userTable . ";";
        return $this->db->connection->query($query);
    }

             
    }






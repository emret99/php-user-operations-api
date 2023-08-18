<?php

namespace App\Controllers;

use App\Helpers\ReplaceWord;
use App\Models\User;
use App\Models\Database;
use App\Controllers\ResponseController;
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

    private function getAllUsers(){

         return $this->db->connection->query(query:"SELECT * FROM " .User::$userTable  .  ";",fetchMode:\PDO::FETCH_ASSOC)->fetchAll();
    }
    private function getWhere($data){
       $this->checkColumn($data['column']);

       $query = " SELECT * FROM ". User::$userTable . " WHERE ". $data['column'] . " = :value";
       
       $stmt =  $this->db->connection->prepare(query:$query);

       $stmt->execute(params:["value"=>$data['value']]);

       $result = $stmt->fetchAll(mode:\PDO::FETCH_ASSOC);

       return $result;


    }
    private function checkColumn($column){
        if (!(array_key_exists(key:$column,array:User::$columns))) {
            return false;
       }
       return true;


    }
    private function checkSuccess($data,$errMsg="", $successMsg=""){
        if ($data) {
            $response = new ResponseController(statuscode:200,Data:[$data],infoMessage:$successMsg);
            $response->create();

        }
        else{
            $response = new ResponseController(statuscode:400,Data:[],infoMessage:$errMsg);
            $response->create();
        }


    }



    public  function getAll(){

        $data = $this->getAllUsers();

        return $this->checkSuccess(data:$data,errMsg:"Could not found any user",successMsg:"Fetched users successfully");
        

 
    }


    public  function login($param){
        $usr = new User(username:$param['username'],password:$param['password']);


         $stmt = $this->db->connection->
         prepare(query:"SELECT * FROM ". User::$userTable ."  WHERE ".User::$columns['username']." = :username AND ".User::$columns['password']." = :password");

         $stmt->execute(params:array("username"=>$usr->username,"password"=>$usr->password));

         $data= $stmt->fetchAll(mode:\PDO::FETCH_ASSOC);

         $this->checkSuccess(data:$data,errMsg:"User not found",successMsg:"Logged in successfully");
         return true;
         
    }


    public  function getBy($data){
         if (!$this->checkColumn($data['column'])) {
            return $this->checkSuccess(false,"Column not found");
         }

        $result = $this->getWhere(data:$data);

        $this->checkSuccess(data:$result,errMsg:"Could not found any users for given credentials",successMsg:"Fetched users successfully");    
        return true;

    }


    public  function register( $user){

        $user = new User(firstName:$user['firstname'],lastName:$user['lastname'],address:$user['address'],city:$user['city'],username:$user['username'],password:$user['password'],email:$user['email'],created_at:$user['created_at']);

        $userArr= $this->getAllUsers();

        foreach ($userArr as $item) {
            
            

            if ($item['username'] === $user->username) {
                return $this->checkSuccess(data:false,errMsg:"User already exists");
            }  
        }

        $query = "INSERT INTO ". User::$userTable ."(".implode(separator:',',array:User::$columns).")
        VALUES (?,?,?,?,?,?,?,?);
        ";

        $data= $this->db->connection->
        prepare(query:$query)->
        execute(params:array($user->firstName,$user->lastName,$user->address,$user->city,$user->username,$user->password,$user->email,$user->created_at)); 
         $this->checkSuccess(data:$data,successMsg:"User created successfully");

         return true;

    }



    public function remove($user){

       $res = $this->getWhere(data:["column"=>$user['column'],"value"=>$user['value']]);
       if (!$res) {
            $this->checkSuccess(data:false,errMsg:"User not found");
            return false;
       }
            $success= $this->db->connection->prepare(query:"DELETE FROM ". User::$userTable ." WHERE ".$user['column']."=:value;")->execute(array("value"=>$user['value']));  
            $this->checkSuccess(data:$success,successMsg:"Users deleted successfully");
            return true;              
    }

    public function removeAll(){
        $data= $this->db->connection->
        prepare(query:"TRUNCATE TABLE " . User::$userTable . ";")->
        execute();
         $this->checkSuccess(data:$data,errMsg:"Delete operation failed",successMsg:"All records deleted successfully");
    }

    public function createFakeUser($count = null){
        $faker = \Faker\Factory::create(locale:"tr_Tr");
        $success = null;


        if(isset($count)) {
            for ($i=0; $i < $count['userCount'] ; $i++) { 
                $user =  ["firstname"=>$faker->firstName(),"lastname"=>$faker->lastName(),"address"=>$faker->address(),"city"=>$faker->city(),"username"=>$faker->username(),"password"=>$faker->password(),"email"=>$faker->email(),"created_at"=>$faker->date()."-".$faker->time()];
                $success= $this->register(user:$user);
            }

            $this->checkSuccess(data:$success);

            return true;
            
        }
        else{
            $user = ["firstname"=>$faker->firstName(),"lastname"=>$faker->lastName(),"address"=>$faker->address(),"city"=>$faker->city(),"username"=>$faker->userName(),"password"=>$faker->password(),"email"=>$faker->email(),"created_at"=>$faker->date()."-".$faker->time()];
            $this->register(user:$user);
            return true;
        }


    }
    public function changeVal($params){
        var_dump($params);
        $res = $this->getWhere($params);
        if (!$res) {
            $this->checkSuccess(false,"User not found");
            return false;
        }

    }



}
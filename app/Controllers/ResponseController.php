<?php


namespace App\Controllers;


class ResponseController{




   private static $status = array(
        100 => 'Continue',  
        101 => 'Switching Protocols',  
        200 => 'OK',
        201 => 'Created',  
        202 => 'Accepted',  
        203 => 'Non-Authoritative Information',  
        204 => 'No Content',  
        205 => 'Reset Content',  
        206 => 'Partial Content',  
        300 => 'Multiple Choices',  
        301 => 'Moved Permanently',  
        302 => 'Found',  
        303 => 'See Other',  
        304 => 'Not Modified',  
        305 => 'Use Proxy',  
        306 => '(Unused)',  
        307 => 'Temporary Redirect',  
        400 => 'Bad Request',  
        401 => 'Unauthorized',  
        402 => 'Payment Required',  
        403 => 'Forbidden',  
        404 => 'Not Found',  
        405 => 'Method Not Allowed',  
        406 => 'Not Acceptable',  
        407 => 'Proxy Authentication Required',  
        408 => 'Request Timeout',  
        409 => 'Conflict',  
        410 => 'Gone',  
        411 => 'Length Required',  
        412 => 'Precondition Failed',  
        413 => 'Request Entity Too Large',  
        414 => 'Request-URI Too Long',  
        415 => 'Unsupported Media Type',  
        416 => 'Requested Range Not Satisfiable',  
        417 => 'Expectation Failed',  
        500 => 'Internal Server Error',  
        501 => 'Not Implemented',  
        502 => 'Bad Gateway',  
        503 => 'Service Unavailable',  
        504 => 'Gateway Timeout',  
        505 => 'HTTP Version Not Supported');
        public int $statusCode;
        public $Data;
        public string $infoMessage;

        public function __construct(
             int $statuscode,
             mixed $Data,
             string $infoMessage =null

     

        ){
            $this->Data = $Data;
            
            if (!array_key_exists($statuscode,self::$status)) {
                $this->statusCode = 500;
                
                
            }
            else{
                $this->statusCode = $statuscode;
                if ($infoMessage) {
                    $this->infoMessage = $infoMessage;
                }
                else {
                
                    $this->infoMessage = self::$status[$statuscode];
                }
            }
           

        }
        public static function getStatus(){
            return self::$status;
        }
        public function SetHeader(){
            header("HTTP/1.1 ". $this->statusCode." " . self::$status[$this->statusCode]);
            header("Content-Type: application/json; charset=utf-8");
            
        }

        public function create(){
             print_r(json_encode($this));
        }
        





}


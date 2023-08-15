<?php


namespace App\Controllers;


class Error extends Response
{
    public string $errMessage;
    public function __construct(
        public int $errCode,
        ){

            $status = Response::getStatus();
            $this->errMessage = $status[$this->errCode];
            

    }


}
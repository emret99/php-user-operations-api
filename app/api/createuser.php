<?php

require_once("../../vendor/autoload.php");
use App\Controllers\RequestController;

$req = new RequestController($_SERVER);
$req->answer();


?>
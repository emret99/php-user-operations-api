<?php

use App\Controllers\RequestController;
require_once("../../vendor/autoload.php");

$req = new RequestController($_SERVER);
$req->answer();


?>
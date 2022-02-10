<?php
date_default_timezone_set("Asia/Bangkok");

$data = array(
    "server" => "",
    "db" => "",
    "user" => "",
    "password" => "",
);

try {
    $conn = new PDO("sqlsrv:server=" . $data["server"] . "; database=" . $data["db"], $data["user"], $data["password"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connect pass';
} catch (Exception $e) {
    echo 'Cannot connect to database server! ' . $e->getMessage();
}


  

 

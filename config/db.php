<?php
date_default_timezone_set("Asia/Bangkok");

$data = array(
    "server" => "SQLC1",
    "db" => "SRUtilities",
    "user" => "sa",
    "password" => "Kiss@@33",
);

try {
    $conn = new PDO("sqlsrv:server=" . $data["server"] . "; database=" . $data["db"], $data["user"], $data["password"]);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo 'Connect pass';
} catch (Exception $e) {
    echo 'Cannot connect to database server! ' . $e->getMessage();
}


  

 

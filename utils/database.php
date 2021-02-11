<?php
function getDatabaseConnection():PDO{
    $dbname = "wingman";
    $port = 3307;
    $user = "root";
    $pwd = "root";
    return new PDO("mysql:host=localhost;dbname=$dbname;port=$port;charset=utf8",$user,$pwd);
}
?>
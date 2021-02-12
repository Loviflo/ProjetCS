<?php
function getDatabaseConnection():PDO{
    $dbname = "wingman";
    $port = 3306;
    $user = "root";
    $pwd = "4qXNvzsq";
    return new PDO("mysql:host=localhost;dbname=$dbname;port=$port;charset=utf8",$user,$pwd);
}
?>
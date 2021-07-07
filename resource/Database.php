<?php

$username = 'root';
$dsn = 'mysql: host=localhost; dbname=register';
$password = '';


//wrap this up in a try catch block

try{
    
    $db = new PDO($dsn, $username, $password);

    $db -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
}catch (PDOException $ex){
    echo "Connection failed : " . $ex -> getMessage();
}

?>
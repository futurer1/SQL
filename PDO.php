<?php
//подключение
try {  
    //MS SQL Server и Sybase через PDO_DBLIB  
    $DBH = new PDO("mssql:host=$host;dbname=$dbname", $user, $pass);  
    $DBH = new PDO("sybase:host=$host;dbname=$dbname", $user, $pass);  
  
    //MySQL через PDO_MYSQL  
    $DBH = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);  
  
    //SQLite  
    $DBH = new PDO("sqlite:my/database/path/database.db");  
} catch(PDOException $e) {  
    echo $e->getMessage();  
}

//закрытие подключения
$DBH = null;
?>

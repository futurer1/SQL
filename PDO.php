<?php
//подключение через класс PDO
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

//выполнение запроса INSERT или UPDATE
$STH = $DBH->prepare("INSERT INTO table_name ( field_name ) VALUES ( 'Test test test!' )"); //подготовка данных, с защитой от иньекций
$STH->execute();    //выполнение запроса

//Использование placeholder-ов для составления запросов:

//Пример 1. Именные метки. Последовательная привязка переменных к меткам.
$STH = $DBH->prepare("INSERT INTO table_name (field1, field2, field3) VALUES (:name_mark1, :name_mark2, :name_mark3)");  //запрос с метками
//Двоеточие не обязательно, но общепринято
$STH->bindParam(':name_mark1', $val1);    //привязка переменных к меткам
$STH->bindParam(':name_mark2', $val2);
$STH->bindParam(':name_mark3', $val3);
$STH->execute();    //выполнение запроса

//Пример 2. Именные метки. Привязка переменных к меткам через ассоциативный массив.
$mas_data = array( 'name_mark1' => 'Some name', 'name_mark2' => 'Some Address', 'name_mark3' => 'Some City' );  
$STH = $DBH->prepare("INSERT INTO table_name (field1, field2, field3) values (:name_mark1, :name_mark2, :name_mark3)");
$STH->execute($mas_data);   //отправляем массив с данными для подготовленного запроса
?>

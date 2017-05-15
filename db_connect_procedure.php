<?php
/**
Соединение с локальной базой данных.
Процедурный стиль.
*/

$host="localhost";
$user="root";
$password="";
$database="name_db";

$con = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    echo "Failed to connect to MySql: ". mysqli_connect_error();
}
$result = mysqli_query($con, "SELECT * FROM test_table");

while($row = mysqli_fetch_array($result)) {
  //разбираем результаты
}
?>

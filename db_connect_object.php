<?php
/*
Соединение с локальной базой данных.
Объектно ориентированный стиль.
*/
$db_host="localhost";
$db_login="root";
$db_passw="";
$db_name="name_db";

class foo_mysqli extends mysqli
{
  public function __construct($host, $user, $pass, $db)
  {
    parent::__construct($host, $user, $pass, $db);
    if (mysqli_connect_error()) {
      die('Ошибка подключения (' . mysqli_connect_errno() . ') '
        . mysqli_connect_error());
    }
  }
}
	
$dblink = new foo_mysqli($db_host, $db_login, $db_passw, $db_name);
if ($result = $dblink->query("SELECT * FROM test_table")) {
    while($row = mysqli_fetch_array($result)) {
        //разбираем результаты
    }
}
?>

<?php
//Мануал:    http://php.net/manual/ru/book.pdo.php
//Подключение через класс PDO
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

//Пример 3. Безымянные метки. Последовательная привязка
$STH = $DBH->prepare("INSERT INTO table_name (field1, field2, field3) values (?, ?, ?)");
$STH->bindParam(1, $val1);    //это не ошибка, нумерация для безымянных меток начинается именно с 1
$STH->bindParam(2, $val2);    //http://php.net/manual/ru/pdostatement.bindparam.php
$STH->bindParam(3, $val3);
$STH->execute();

//Пример 4. Безымянные метки. Привязка переменных через массив.
$STH = $DBH->prepare("INSERT INTO table_name (field1, field2, field3) values (?, ?, ?)");
$mas_data = array('Some value for field1', 'Some value for field2', 'Some value for field3');
$STH->execute($mas_data);


//Выполнение запроса SELECT и разбор результатов

//Пример 1. PDO::FETCH_ASSOC
$STH = $DBH->query("SELECT field1, field2, field3 FROM table_name"); //сразу запрос без подготовки, т.к. в запросе нет меток
$STH->setFetchMode(PDO::FETCH_ASSOC);   //режим отображения выборки
/*Основные:
PDO::FETCH_ASSOC: возвращает массив с названиями столбцов в виде ключей
PDO::FETCH_CLASS: присваивает значения столбцов соответствующим свойствам указанного класса.
                  Если для какого-то столбца свойства нет, оно будет создано
PDO::FETCH_OBJ:   возвращает анонимный объект со свойствами, соответствующими именам столбцов
*/
while($res = $STH->fetch()) {  
    //работаем с ассоциативным массивом, где ключ - название поля таблицы
    //$res['field1'], $res['field2'], $res['field3']
}

//Пример 2. PDO::FETCH_CLASS
$STH = $DBH->query("SELECT field1, field2, field3 FROM table_name");
$STH->setFetchMode(PDO::FETCH_CLASS, 'SomeClass');                              //конструктор вызовется ПОСЛЕ присвоения значений
//$STH->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'SomeClass');    //конструктор вызовется ДО присвоения значений
class SomeClass
{
    public $field1; //заполнение значений (по умолчанию) происходит ДО вызова конструктора
    public $field2;
    public $field3;

    function __construct($tmp_str="...") {    //можно обрабатывать данные в конструкторе класса
        $this->field1 = ($this->field1).$tmp_str;   //присоединили три точки в конец переменной
    }  
}

while($obj = $STH->fetch()) {   //перебираем безымянные объекты класса SomeClass
    echo $obj->field1;
    echo $obj->field2;
    echo $obj->field3;
}

//Пример 2. PDO::FETCH_OBJ
$STH = $DBH->query("SELECT field1, field2, field3 FROM table_name");
$STH->setFetchMode(PDO::FETCH_OBJ);

?>

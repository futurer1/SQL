<?php
$data = [
            'field_1' => $val1,
            'field_2' => $val2,
            'field_3' => $val3
        ];
        
// поля вписываются в таблицу table_name

$sql = <<<SQL
INSERT INTO
  table_name
SET
  ?a
SQL;

$this->db->query($sql, $data);

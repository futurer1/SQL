SELECT `table_name1`.`field1`,
        `table_name2`.`field1`
FROM    `table_name1`, `table_name2` 
WHERE   `table_name1`=NOW() AND 
        (`table_name2`.`field1` BETWEEN 4 AND 6) AND 
        `table_name2`.`field2` > 5
ORDER BY `field1` DESC LIMIT 1

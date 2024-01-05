SELECT `table_name1`.`field1`,
        `table_name2`.`field1`
FROM    `table_name1`, `table_name2` 
WHERE   `table_name1`=NOW() AND 
        (`table_name2`.`field1` BETWEEN 4 AND 6) AND 
        `table_name2`.`field2` > 5
ORDER BY `field1` DESC LIMIT 1

SELECT COUNT(WCustomer=1) as countC,
				COUNT(WSeller=1) as countS,
				COUNT(WLessor=1) as countL,
				COUNT(WRenter=1) as countR
		FROM (		SELECT  `calls`.`CallID`, 
					`calls`.`ClientID`, 
					`clients`.`WC`, 
					`clients`.`WS`, 
					`clients`.`WL`, 
					`clients`.`WR`
				FROM 	`calls`, `clients`
				WHERE 	`calls`.`Stamp`>='".$arg1[0]." 00:00:00' AND 
					`calls`.`Stamp`<='".$arg1[1]." 23:59:59' AND 
					(`clients`.`WC` IS NOT NULL OR 
					`clients`.`WS` IS NOT NULL OR 
					`clients`.`WL` IS NOT NULL OR 
					`clients`.`WR` IS NOT NULL) AND 
					`clients`.`ClientID`=`calls`.`ClientID` 
		) as `tmp_table`

SELECT `items`.`ItemID`, 
	`items`.`MetatagsID`, 
	`items`.`ManufacturerID`, 
	`items`.`MeasureID`, 
	`items`.`NameItem$lang` as `NameItem`, 
	`items`.`AnnotItem$lang` as `AnnotItem`, 
	`items`.`DescrItem$lang` as `DescrItem`, 
	`items`.`ItemPrice`, 
	`items`.`Status`, 
	`index_items`.`FolderID`, 
	`seo_metatags`.`TitleP$lang` as `TitleP`, 
	`seo_metatags`.`DescriptionP$lang` as `DescriptionP`, 
	`seo_metatags`.`RobotsP$lang` as `RobotsP`, 
	`seo_metatags`.`KeywordsP$lang` as `KeywordsP` 
FROM 	`index_items`, `items`, `seo_metatags` 
WHERE 	`index_items`.`IndexID`=".$idi." AND 
	`items`.`ItemID`=`index_items`.`ItemID` AND 
	`seo_metatags`.`MetatagsID`=`items`.`MetatagsID` 
LIMIT 1


/* Выведет 1 или 0 в зависимости от наличия записей, удовлетворяющих запросу */
SELECT
  IF (COUNT(*), 1, 0)
FROM
  table_name
WHERE
  field1='some' AND 
  field2=234


/* Взятие суммы из двух сумм, взятых из разных полей разных таблиц */
SELECT SUM(tmp_sum)
  FROM (        
	SELECT SUM(tbl_1.field11) as tmp_sum FROM tbl_1
	
	UNION ALL
  
	SELECT SUM(tbl_2.field22) as tmp_sum FROM tbl_2
  ) as tmp_tbl

/*
SELECT ('столбцы или * для выбора всех столбцов; обязательно')
FROM ('таблица; обязательно')
WHERE ('условие/фильтрация, например, city = 'Moscow'; необязательно')
GROUP BY ('столбец, по которому хотим сгруппировать данные; необязательно')
HAVING ('условие/фильтрация на уровне сгруппированных данных; необязательно')
ORDER BY ('столбец, по которому хотим отсортировать вывод; необязательно')
*/

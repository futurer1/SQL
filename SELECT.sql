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

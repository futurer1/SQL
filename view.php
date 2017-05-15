<?php
/**
 * Использование представлений в запросах
 */
$qs="CREATE OR REPLACE VIEW `view_open_deals` AS 
		SELECT `tbl_1`.`UserID`,  
				`tbl_1`.`DealID`, 
				`tbl_1`.`ObjectID`, 
				`tbl_1`.`DealNum`, 
				`tbl_1`.`OpenDealDate`,
				`tbl_3`.`Personrus`,
				`tbl_4`.`ObjName`, 
				`tbl_4`.`ObjID`, 
				`tbl_4`.`ArchiveID`, 
				`tbl_5`.`DocPackID` 
		FROM 	`tbl_1`, `tbl_2`, `tbl_3`, `tbl_4`, `tbl_5` 
		WHERE 	`tbl_1`.`OpenDate` IS NOT NULL AND 
				`tbl_1`.`OpenDealDate` IS NOT NULL AND 
				`tbl_1`.`FinishDate` IS NULL AND 
				`tbl_1`.`CancelDate` IS NULL AND 
				`tbl_1`.`OpenDealDate`>='".$val." 00:00:00' AND 
				`tbl_1`.`OpenDealDate`<='".$val." 23:59:59' AND 
				`tbl_2`.`UserID`=`tbl_1`.`UserID` AND 
				`tbl_2`.`IDPeople`=`tbl_3`.`ID` AND 
				`tbl_4`.`ObjectID`=`tbl_1`.`ObjectID` AND 
				`tbl_5`.`DealID`=`tbl_1`.`DealID` 
		GROUP BY `tbl_1`.`DealID` 
		ORDER BY `tbl_3`.`Personrus` 
	";

$qs="
		SELECT `view_open_deals`.`UserID`, 
				`view_open_deals`.`Personrus`, 
				`view_open_deals`.`DealID`, 
				`view_open_deals`.`DealNum`, 
				`view_open_deals`.`OpenDealDate`,
				`view_open_deals`.`ObjectID`, 
				`view_open_deals`.`ObjName`, 
				`view_open_deals`.`ObjID`, 
				`view_open_deals`.`ArchiveID`, 
				`tmp_tbl`.`present_procent` 
		FROM 	`view_open_deals`, 
				(SELECT	`absent_tbl`.`DocPackID`, 
						CEIL(((`all_tbl`.`all_count`-`absent_tbl`.`absent_count`)/`all_tbl`.`all_count`)*1000)/10 AS `present_procent`
				FROM 
					(	SELECT `tbl_6`.`DocPackID`, 
								COUNT(*) AS `absent_count` 
						FROM 	`view_open_deals`, `tbl_6`
						WHERE 	`tbl_6`.`DocPackID`=`view_open_deals`.`DocPackID` AND 
								`tbl_6`.`PutCloseBase`='0'
						GROUP BY `tbl_6`.`DocPackID`
					) AS `absent_tbl`, 
					(	SELECT `tbl_6`.`DocPackID`, 
								COUNT(*) AS `all_count` 
						FROM 	`view_open_deals`, `tbl_6`
						WHERE 	`tbl_6`.`DocPackID`=`view_open_deals`.`DocPackID` 
						GROUP BY `tbl_6`.`DocPackID`
					) AS `all_tbl` 
				WHERE `absent_tbl`.`DocPackID`=`all_tbl`.`DocPackID`
				) AS `tmp_tbl` 
		WHERE `view_open_deals`.`DocPackID`=`tmp_tbl`.`DocPackID`
		";

$qd="DROP VIEW `view_open_deals`";

<?php
/**
 * Created by PhpStorm.
 * User: 1
 * Date: 07.05.2017
 * Time: 14:21
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
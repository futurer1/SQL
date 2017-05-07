<?php
/**
 * Date: 07.05.2017
 * Time: 14:48
 * Count по сгенеренной таблице
 */
$qs="SELECT `const_clients_table`.`UserID`, 
				COUNT(*) as `count_const_clients` 
		FROM (
				SELECT	`index_c`.`ClientID` as `constClientID`, 
						`index_c`.`UserID` 
				FROM 	`index_c`, `cli` 
				WHERE 	`index_c`.`ClientID`=`cli`.`ClientID` AND 
						`cli`.`CreateDate`>='".$val1." 00:00:00' AND 
						`cli`.`CreateDate`<='".$val2." 23:59:59' AND 
						`index_c`.`UserID` IN (
					SELECT `adm`.`UserID`
					FROM 	`adm` 
					WHERE 	`adm`.`UserType` IN ('1', '2', '5', '7') AND 
							`adm`.`Password` IS NOT NULL AND 
							`adm`.`PasswordDate` IS NOT NULL AND 
							`adm`.`IDPeople` IS NOT NULL 
						) AND 
						(`index_c`.`BestBefore` IS NULL OR `index_c`.`BestBefore`<NOW())
				GROUP BY `constClientID`
				ORDER BY `index_c`.`UserID` 
			 ) as `const_clients_table` 
		GROUP BY `const_clients_table`.`UserID`
		";
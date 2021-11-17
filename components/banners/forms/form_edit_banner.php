<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s ". mysqli_connect_error());
	$db->set_charset("utf8");

	$bannerId = $_GET["banner_id"];

	$sql_00 = "	SELECT 
					*
				FROM
					painel_banners as t1
				WHERE 
						(t1.deleted_at IS NULL OR t1.deleted_at = '')
					AND t1.id = '".$bannerId."'
				ORDER BY
					t1.created_at  DESC";
	$result_00 = $db->query($sql_00) or die($sql_00 . '-' . $db->error  );

	if( $result_00 ){
		$row_00 = $result_00->fetch_array();
		$name = $row_00["name"];
		$duration = $row_00["duration"];
		$active = $row_00["active"];
	}

 
	header("Content-type: text/xml");
	echo('<?xml version="1.0" encoding="UTF-8"?>'); 
	echo('<items>');
		echo('<item type="block" width="auto" blockOffset="5">');
 
			echo('<item type="block" width="auto" blockOffset="5">');
				echo('<item label="Name" 				labelWidth="115"	name="name"  	type="input" width="180"	required="true" value="'.$name.'"  />');	
				echo('<item label="Duration(seconds)" 	labelWidth="115"	name="duration"	type="input" width="50"  	required="true" validate="NotEmpty,ValidInteger" value="'.$duration.'"  />');	
				echo('<item label="Active" 				labelWidth="115" 	name="active" type="combo" width="50" validate="NotEmpty"  readonly="true" required="true" >');
				if( $active ){
					echo('<option value="1" text="Sim" selected="true" />');			
					echo('<option value="0" text="Não" />');					
				}else{
					echo('<option value="1" text="Sim" />');			
					echo('<option value="0" text="Não" selected="true" />');	
				}
			echo('</item>');
			echo('</item>');		
		echo('</item>');		
	echo('</items>');

?>
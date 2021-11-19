<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s\n". mysqli_connect_error());

	$sql_00 = "	SELECT 
					* 
				FROM 
					users 
				WHERE 
						departamento like '%nform%ticos%'
					AND login = '".$res_login."'  ";
	$result_00 = $db->query($sql_00) or die($sql_00 . '-' . $db->error  );

	$PERMISSIONS = ( $result_00->num_rows > 0 ? 1 : 0 );
 
	header("Content-type: text/xml");
	echo('<?xml version="1.0" encoding="UTF-8"?>');
	echo('<menu>');		
		if( $PERMISSIONS ){
			echo('<item text="Permissions" img="key.png">');
				echo('<item id="permissoes_banner_qualidade" text="Banner Qualidade" img="key.png" />');
			echo('</item>');	
		}
	echo('</menu> ');			
	$db->close();
?>

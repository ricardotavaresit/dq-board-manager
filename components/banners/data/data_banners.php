<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s ". mysqli_connect_error());
	$db->set_charset("utf8");

    $sql_00 = "	SELECT 
					*
				FROM
                    painel_banners as t1
				WHERE 
						(t1.deleted_at IS NULL OR t1.deleted_at = '')
				ORDER BY
					t1.created_at  DESC";
	$result_00 = $db->query($sql_00) or die($sql_00 . '-' . $db->error  );

	header("Content-type: text/xml");
	echo('<?xml version="1.0" encoding="UTF-8"?>'); 
	echo('<rows>');
		if( $result_00 ){
			while( $row_00 = $result_00->fetch_array() ){
				print("<row id=\"".$row_00["id"]."\">");
					print("<cell><![CDATA[".$row_00["name"]."]]></cell>");
					print("<cell><![CDATA[".$row_00["duration"]."]]></cell>");
					$status = ($row_00["active"] == 1 ? 'Sim' : 'Não' );
					print("<cell><![CDATA[".$status."]]></cell>"); 
				print("</row>");
			}
		 
		}
	echo '</rows>';	
?>
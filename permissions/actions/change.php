<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s\n". mysqli_connect_error());

   
    if($_GET["menu"] == 1){ // Banner Qualidade

		if($_GET["cell"] == '1'){
			$sql_00 = "UPDATE painel_banners_permissions SET show_banner = IF(show_banner = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '2'){
			$sql_00 = "UPDATE painel_banners_permissions SET add_banner = IF(add_banner = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '3'){
			$sql_00 = "UPDATE painel_banners_permissions SET edit_banner = IF(edit_banner = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '4'){
			$sql_00 = "UPDATE painel_banners_permissions SET delete_banner = IF(delete_banner = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '5'){
			$sql_00 = "UPDATE painel_banners_permissions SET show_element = IF(show_element = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '6'){
			$sql_00 = "UPDATE painel_banners_permissions SET add_element = IF(add_element = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '7'){
			$sql_00 = "UPDATE painel_banners_permissions SET edit_element = IF(edit_element = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '8'){
			$sql_00 = "UPDATE painel_banners_permissions SET delete_element = IF(delete_element = 0,1,0) WHERE id=".$_GET["id"];
		}else if($_GET["cell"] == '9'){
			$sql_00 = "UPDATE painel_banners_permissions SET `active` = IF(`active` = 0,1,0) WHERE id=".$_GET["id"];
		}
	}

	$result_00 = $db->query($sql_00) or die($sql_00);		
	
	$db->close();
?>
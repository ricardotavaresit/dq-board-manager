<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s ". mysqli_connect_error());
	$db->set_charset("utf8");

	try {
		$sql_05 = " UPDATE  
						painel_banners 
					SET 
						name = ?, 
						duration = ?, 
						active = ?, 
						updated_by = ?, 
						updated_at = ?
					WHERE 
						id = '".$_GET["banner_id"]."'";
		$stmt = $db->prepare($sql_05);

		$stmt->bind_param("ssiss", $name,$duration,$active,$updatedBy,$updatedAt);

		$name			=	$_POST["name"]; 
		$duration		=	$_POST["duration"]; 
		$active			=	$_POST["active"]; 
		$updatedBy 		=	$res_login;
		$updatedAt 		= 	date("Y-m-d H:i:s"); 

		if( $stmt->execute() ){ 
			$message = array("status" => 200, "msg" =>  $db->insert_id);
		}

	} catch (mysqli_sql_exception $exception) {
		$message = array("status" => 200, "msg" =>  array( $exception));
	// $db->rollback();
		throw $exception;
	}
	echo json_encode( $message );
?>
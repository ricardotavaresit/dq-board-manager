<?php

	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s ". mysqli_connect_error());
	$db->set_charset("utf8");

	try {
		$sql_05 = " INSERT INTO 
						painel_banners (name, duration, active, created_by, created_at)
					VALUES (?,?,?,?,?)";
		$stmt = $db->prepare($sql_05);
		$stmt->bind_param("ssiss", $name, $duration, $active, $createdBy, $createdAt);

		$name		=	$_POST["name"]; 
		$duration	=	$_POST["duration"]; 
		$active		=	$_POST["active"]; 
		$createdBy	=	$res_login;
		$createdAt 	= 	date("Y-m-d H:i:s"); 

		if( $stmt->execute() ){ 
			$message = array("status" => 200, "msg" =>  $db->insert_id);
		}

	} catch (mysqli_sql_exception $exception) {
		$message = array("status" => 400, "msg" => $exception);
		throw $exception;
	}
		 
	echo json_encode( $message );

?>
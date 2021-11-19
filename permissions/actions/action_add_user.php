<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';  
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s\n". mysqli_connect_error());

	$id_user = $_POST['id_user'];

	switch($_GET["menu"]){

		case 1 :	

			$sql_00 = "	SELECT *
						FROM  painel_banners_permissions 
						WHERE id_func = '".$id_user."'";

			$result_00 = $db->query($sql_00) or die($sql_00 . '-' . $db->error  );

			if( $result_00->num_rows > 0 ){
				$message = array("status" => 400, "msg" => 'O utilizador já existe na lista');
			}else{
				$sql_05 = "INSERT INTO painel_banners_permissions SET id_func=".$id_user; 
				$result_05 = $db->query($sql_05) or die($sql_05 . '-' . $db->error );

				if( $result_05 ){
					$message = array("status" => 200, "msg" => $db->insert_id );
				}else{ 
					$message = array("status" => 400, "msg" => 'O utilizador já existe na lista');
				}
			} 
			echo json_encode( $message ); 
			break; 
		default:break;
	} 
	$db->close();


 
?>

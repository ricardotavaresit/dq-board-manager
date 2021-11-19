<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';  
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s\n". mysqli_connect_error());

	$id = $_GET['id'];
 

	switch($_GET["menu"]){

		case 1 :	

		 
            $sql_05 = "DELETE FROM painel_banners_permissions WHERE id = '".$id."'";
            $result_05 = $db->query($sql_05) or die($sql_05 . '-' . $db->error );

            if( $result_05 ){
                $message = array("status" => 200, "msg" => '' );
            }else{ 
                $message = array("status" => 400, "msg" => 'Erro');
            }
		 
			echo json_encode( $message ); 
			break; 
		default:break;
	} 
	$db->close();


 
?>

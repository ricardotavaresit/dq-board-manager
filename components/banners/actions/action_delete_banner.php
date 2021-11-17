<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s ". mysqli_connect_error());
 
	try {
        $banner_id = $_GET["banner_id"]; 

        $sql_00 = "	SELECT 
                        *
                    FROM
                        painel_banners_elements as t1
                    WHERE 
                            t1.banner_id = ".$banner_id."
                        AND (t1.deleted_at IS NULL OR t1.deleted_at = '')";
        $result_00 = $db->query($sql_00) or die($sql_00 . '-' . $db->error  );

        if( $result_00->num_rows > 0 ){
            $message = array("status" => 400, "msg" => 'The selected banner has associated elements.'); 
        }else{
            $sql_05 = " UPDATE  
                            painel_banners 
                        SET 
                            deleted_by = ?, 
                            deleted_at = ?
                        WHERE 
                            id = '".$banner_id."'";
            $stmt = $db->prepare($sql_05);
    
            $stmt->bind_param("ss", $deletedBy, $deletedAt);
    
            $deletedBy 	=	$res_login;
            $deletedAt 	= 	date("Y-m-d H:i:s"); 
    
            if( $stmt->execute() ){ 
                $message = array("status" => 200, "msg" => '');
            }
        }
	} catch (mysqli_sql_exception $exception) {
		$message = array("status" => 400, "msg" =>  array( $exception));
		throw $exception;
	}
	echo json_encode( $message );

?>
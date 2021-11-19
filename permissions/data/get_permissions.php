<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
    $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s ". mysqli_connect_error());
    $db->set_charset("utf8");

   	$sql_00 = "	SELECT 
					IFNULL(t1.show_banner,0)	AS show_banner,
					IFNULL(t1.add_banner,0)	    AS add_banner, 
					IFNULL(t1.edit_banner,0)	AS edit_banner, 
					IFNULL(t1.delete_banner,0)	AS delete_banner, 
					IFNULL(t1.show_element,0)	AS show_element, 
					IFNULL(t1.add_element,0)	AS add_element, 
					IFNULL(t1.edit_element,0)	AS edit_element, 
					IFNULL(t1.delete_element,0)	AS delete_element
				FROM 
                    painel_banners_permissions as t1,
					users as t2
				WHERE 
					    t2.id = t1.id_func
                    AND t1.active = 1
					AND t2.login = '".$res_login."'";
    $result_00 = $db->query($sql_00) or die($sql_00 . '-' . $db->error  );
 

    if( $result_00 ){
        $row_00 = $result_00->fetch_array();
            $data = array(
                'show_banner' 	    =>	$row_00["show_banner"],
                'add_banner' 	    =>  $row_00["add_banner"],
                'edit_banner' 	    =>  $row_00["edit_banner"],
                'delete_banner'     =>  $row_00["delete_banner"],
                'show_element'      =>  $row_00["show_element"],
                'add_element'       =>  $row_00["add_element"],
                'edit_element'      =>  $row_00["edit_element"],
                'delete_element'    =>  $row_00["delete_element"],
            );
        if( $_GET["type"] == 'js' ){
            echo json_encode($data);
        }else{
            return $permissoes = $data;
        }
    }
?>
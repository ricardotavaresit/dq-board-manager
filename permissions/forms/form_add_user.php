<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
    $db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s ". mysqli_connect_error());

    $sql_00 = " SELECT 
                    * 
                FROM 
                    users 
                WHERE 
                    activo='Sim' 
                ORDER BY 
                    nome";
    $result_00 = $db->query($sql_00) or die($sql_00 . '-' . $db->error  );

	Header('Content-type: text/xml');
	echo('<?xml version="1.0" encoding="UTF-8"?>'); 
	echo('<items>');
		echo('<item type="block"  width="350" >');
			echo('<item name="id_user" type="select" label="Nome" validate="NotEmpty" labelWidth="120" inputWidth="200">');
				echo('<option text="Escolher" value=""/>');
					if( $result_00 ){
						while( $row_00 = $result_00->fetch_array() ){ 
							echo('<option value="'.utf8_encode($row_00["id"]).'" text="'.utf8_encode($row_00["n_cartao"] ." - ".$row_00["nome"]).'" />');
						}
					}
			echo('</item>');
			echo('<item type="block" width="350"  blockOffset="0" >');
				echo('<item name="pesquisar" type="input" label="Pesquisar Nome"  labelWidth="120"  inputWidth="133"/>');
				echo('<item type="newcolumn"  />');
				echo('<item name="bt_pesquisar" type="button" width="25" value="OK"  offsetTop="4" />');
			echo('</item>');
		echo('</item>');
	echo('</items>');
	
?>
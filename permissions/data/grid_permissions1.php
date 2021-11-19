<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';
	$db = new mysqli($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD, $MYSQL_DBINTRANET) or die("Connect failed: %s\n". mysqli_connect_error());
	
	$sql_00 = " SELECT 
					t1.*,
					t2.nome
				FROM 
					painel_banners_permissions as t1,
					users as t2 
				WHERE 
					t2.id = t1.id_func
				ORDER BY 
					t2.n_cartao";
	$result_00 = $db->query($sql_00) or die($sql_00);		
	
	header("Content-type: text/xml");	
	echo('<?xml version="1.0" encoding="UTF-8"?>'); 
	echo('<rows>');
		echo("<head>");				
	 
			echo("<column width='250' 	type='ro' 	align='center' 		sort='str'	>User</column>");	
			echo("<column width='80' 	type='ch' 	align='center' 		sort='str'	>Banners</column>");			
			echo("<column width='60' 	type='ch' 	align='center' 		sort='str'	>#cspan</column>");					
			echo("<column width='60' 	type='ch' 	align='center' 		sort='str'	>#cspan</column>");			
			echo("<column width='60' 	type='ch' 	align='center' 		sort='str'	>#cspan</column>");			
			echo("<column width='80' 	type='ch' 	align='center' 		sort='str'	>Elements</column>");			
			echo("<column width='60' 	type='ch' 	align='center' 		sort='str'	>#cspan</column>");					
			echo("<column width='60' 	type='ch' 	align='center' 		sort='str'	>#cspan</column>");		
			echo("<column width='60' 	type='ch' 	align='center' 		sort='str'	>#cspan</column>");		
			echo("<column width='60' 	type='ch' 	align='center' 		sort='str'	>Ativo</column>");

			echo("<beforeInit>");				
				echo("<call command='attachHeader'>");								
					echo("<param>#rspan,Show,Add,Edit,Delete,Show,Add,Edit,Delete,#rspan</param>");					
				echo(" </call>");			
			
	
			echo("</beforeInit>");

		
		echo("</head>");
	
	if($result_00){				   
		while($row_00 = $result_00->fetch_array()){		
			echo("<row id='".$row_00["id"]."'>");				
				echo("<cell>".utf8_encode(htmlspecialchars($row_00["nome"]))."</cell>");
				echo("<cell>".$row_00["show_banner"]."</cell>");			
				echo("<cell>".$row_00["add_banner"]."</cell>");			
				echo("<cell>".$row_00["edit_banner"]."</cell>");			
				echo("<cell>".$row_00["delete_banner"]."</cell>");			
				echo("<cell>".$row_00["show_element"]."</cell>");			
				echo("<cell>".$row_00["add_element"]."</cell>");			
				echo("<cell>".$row_00["edit_element"]."</cell>");			
				echo("<cell>".$row_00["delete_element"]."</cell>");			
				echo("<cell>".$row_00["active"]."</cell>");			
			echo("</row>");
		}
	}
	echo '</rows>';  
?>

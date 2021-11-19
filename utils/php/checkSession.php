<?php
	require_once $_SERVER['DOCUMENT_ROOT'].'/include/base.php';

	$connection = mysql_connect($MYSQL_HOST, $MYSQL_USER, $MYSQL_PWD) or die ("Não consegui ligar à base de dados.");
	$db = mysql_select_db($MYSQL_DBINTRANET, $connection);
   
	if(!session_is_registered("res_login"))
		echo '0';
	
	mysql_close($connection);
	
?>

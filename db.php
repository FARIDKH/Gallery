<?php
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "";
	$db_name = "gallery";
	$db_conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
	
	function getAll() {
		$SQL = "SELECT * FROM gallery";
		global $db_conn;
		return mysqli_query($db_conn, $SQL);
	}
?>
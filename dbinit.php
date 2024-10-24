<?php
	//MySQLi and PDO
	//Connect to DB
	define('SERVERNAME', 'localhost');
	define('USERNAME', 'root');
	define('PASSWORD', '');
	define('DBNAME', 'phpaditya');

	$conn = mysqli_connect(SERVERNAME,USERNAME,PASSWORD,DBNAME);

	//Check for connection
	if(!$conn){
		echo 'Error in connection: ' . mysqli_connect_error();
	}
	

?>
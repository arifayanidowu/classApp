<?php
	include 'dbconn.php';
	include 'result.php';
$db = new MYSQLIConnection();

	$result = $db->query("SELECT * FROM books");

	while($row = $result->fetch(MYSQLIResult::FETCH_ASSOC)) {
			
		var_dump($row);

	}


			


	
?>
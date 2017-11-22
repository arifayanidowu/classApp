<?php
	session_start();

	include('includes/function.php');

	include('includes/db.php');




	$id = getProductById($conn, $book_id);

	$clean = array_map('trim',$id);

	$delete = deleteProduct($conn, $clean);

	if(isset($delete) == 1){

	echo $delete;
		
	redirect("view_products.php");

	}







?>
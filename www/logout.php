<?php
	
	
	include('includes/function.php');
	include('includes/db.php');

	unset($_SESSION['admin_id']);
	unset($_SESSION['name']);

	redirect("login.php");




?>
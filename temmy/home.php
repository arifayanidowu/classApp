<?php

	session_start();

	$admin_id = $_SESSION['admin_id'];


	$page_title = "Home";
	include('includes/header.php');

	include('includes/db.php');

	include('includes/function.php');

?>


<div class="wrapper">
	<h2 align="center">Welcome to Home page</h2>




</div>

<?php
	
	include('includes/footer.php');

?>
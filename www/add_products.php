<?php
	
	$page_title = "Add Products";

	include('includes/function.php');

	include('includes/dashboard_header.php');

	include('includes/db.php');
	


	
	$error = [];

	if(array_key_exists('add', $_POST)){
	
		if(empty($_POST['fname'])){
			$error['fname']= "Please enter your firstname";
		}
		if(empty($_POST['lname'])){
			$error['lname']= "Please enter your lastname";
		}
		if(empty($_POST['email'])){
			$error['email']= "Please enter your email";
		}
		if(doesEmailExist($conn, $_POST['email'])){
			$error['email'] = "Email already exist";
		}
		if(empty($_POST['password'])){
			$error['password']= "Please enter your password";
		}
		if(empty($_POST['pword'])){
			$error['pword']= "Please confirm your password";
		}

		if(empty($error)){
			$clean = array_map('trim', $_POST);

			doAdminRegister($conn, $clean);
		}

	}
?>

<div class="wrapper">
		<h1 id="register-label">Add products</h1>
		<hr>
		<form id="register"  action ="register.php" method ="POST">
			<div>
				<?php 
				$data = displayErrors($error, 'fname');
				echo $data;
				?>
				<label>Product:</label>
				<input type="text" name="fname" placeholder="first name">
			</div>
			<div>
				<?php 
				$err = displayErrors($error, 'lname');
				echo $err;
				?>
				<label>last name:</label>	
				<input type="text" name="lname" placeholder="last name">
			</div>

			<div>
				<?php 
				$err_email = displayErrors($error, 'email');
				echo $err_email;
				?>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<?php 
				$err_pass = displayErrors($error, 'password');
				echo $err_pass;
				?>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>
 
			<div>
				<?php
				$err_con_pass = displayErrors($error, 'pword');
				echo $err_con_pass;
				?>
				<label>confirm password:</label>	
				<input type="password" name="pword" placeholder="password">
			</div>

			<input type="submit" name="add" value="Add">
		</form>
	</div>

	<?php
		include('includes/footer.php');
	?>

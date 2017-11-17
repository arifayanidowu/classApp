
	<?php

		$page_title = "Login";
		include('includes/header.php');
		include('includes/db.php');
		include('includes/function.php');

		$error = [];

		if(array_key_exists('register', $_POST)){

			if(empty($_POST['email'])){
				$error['email'] = "Please enter your email address";
			} 
			if(empty($_POST['password'])){
				$error['password'] = "Please enter your password";
			}
			if(empty($error)){
				if(validateLogin($conn, $_POST['email'], $_POST['password'])){
					echo "Login successful";
				} else{
					echo "Invalid email/password";
				}


			}

		}




	?>
	<div class="wrapper">
		<h1 id="register-label">Admin Login</h1>
		<hr>
		<form id="register"  action ="login.php" method ="POST">
			<div>
				<label>email:</label>
				<input type="text" name="email" placeholder="email">
			</div>
			<div>
				<label>password:</label>
				<input type="password" name="password" placeholder="password">
			</div>

			<input type="submit" name="register" value="login">
		</form>

		<h4 class="jumpto">Don't have an account? <a href="register.php">register</a></h4>
	</div>

	<?php

		include('includes/footer.php');

	?>

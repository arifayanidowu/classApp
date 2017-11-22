<?php
	session_start();

	$page_title = "Edit Category";

	include('includes/function.php');
	
	include('includes/dashboard_header.php');

	include('includes/db.php');

	


	checkLogin();

	define('MAX_FILE_SIZE', 2097152);

	$ext = ['image/jpeg', 'image/jpg', 'image/png'];

	$flag = ['Top-Selling', 'Trending', 'Recently-Viewed'];

	if($_GET['book_id']){
		$book_id = $_GET['book_id'];
	}

	$item = getProductById($conn, $book_id);

	$error = [];

	if(array_key_exists('edit', $_POST)){

		if(empty($_POST['title'])){
			$error['title'] = "Please enter title";
		}
		if(empty($_POST['author'])){
			$error['author'] = "Please enter author";
		}

		if(empty($error)){
			$clean = array_map('trim', $_POST);

			$clean['id'] = $book_id;

			updateCategory($conn, $clean);

			redirect("view_products.php");

		}

	}


?>
<div class="wrapper">
		<h1 id="register-label">Edit products</h1>
		<hr>
		<form id="register"  action ="" method ="POST" enctype="multipart/form-data">
			<div>
				<?php 
				$info = displayErrors($error, 'title');
				echo $info;
				?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title" value="<?php echo $item[1]; ?>">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'author');
				echo $info;
				?>
				<label>Author:</label>	
				<input type="text" name="author" placeholder="Author" value="<?php echo $item[2]; ?>">
			</div>

			<div>
				<?php 
				$info = displayErrors($error, 'price');
				echo $info;
				?>
				<label>Price:</label>
				<input type="text" name="price" placeholder="Price" value="<?php echo $item[3]; ?>">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'pub_date');
				echo $info;
				?>
				<label>publication date:</label>
				<input type="text" name="pub_date" placeholder="Publication date" value="<?php echo $item[4]; ?>">
			</div>
 

			<div>
				<?php 
				$info = displayErrors($error,'cat');
				echo $info;
				?>
				<label>Category:</label> 
				<select name="cat">
					<option>Select Category</option>
					<?php
						$data = fetchCategory($conn);
						echo $data;
					?>
				</select>

			</div>
			<div>
				<?php 
					$info = displayErrors($error,'flag');
					echo $info;
				?>
				<label>Flag:</label>
				<select name="flag">
					<option>Select Flag</option>
					<?php foreach ($flag as $fl) {?>
					<option value="<?php echo $fl ?>">
						<?php echo $fl ?>
					</option>
					<?php } ?>

				</select>
			</div>

			<div>
				<?php
					$info = displayErrors($error, 'image');
					echo $info;
				?>
				<label>Image:</label>
				<input type="file" name="image">
			</div>	

			<p><input type="submit" name="edit" value="Edit"></p>
		</form>
	</div>

<?php

	include('includes/footer.php');

?>
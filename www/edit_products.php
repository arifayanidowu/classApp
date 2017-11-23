<?php
	session_start();

	$page_title = "Edit products";

	include('includes/function.php');
	
	include('includes/dashboard_header.php');

	include('includes/db.php');

	


	checkLogin();

	if($_GET['book_id']){
		$book_id = $_GET['book_id'];
	}

	$item = getProductById($conn, $book_id);
	/*print_r($item); exit();  This is to know if getProductById fetched any ID*/
	$category = getCategoryById($conn, $item[5]);

	$error = [];

	if(array_key_exists('edit', $_POST)){

		if(empty($_POST['title'])){
			$error['title'] = "Please enter title";
		}
		if(empty($_POST['author'])){
			$error['author'] = "Please enter author";
		}
		if(empty($_POST['price'])){
			$error['price'] = "Please enter price";
		}
		if(empty($_POST['pub_date'])){
			$error['pub_date'] = "Please enter publication date";
		}
		if(empty($_POST['cat'])){
			$error['cat']= "Select a category";
		}

		if(empty($error)){

		
			$clean = array_map('trim', $_POST);

			$clean['id'] = $book_id;

			updateProduct($conn, $clean);

			redirect("view_products.php");

		}

	}


?>
<div class="wrapper">
		<h1 id="register-label">Edit products</h1>
		<hr>
		<form id="register"  action ="" method ="POST">
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
					<option value="<?php echo $category[0]; ?>"><?php echo $category[1]; ?></option>
					<?php
						$data = fetchCategory($conn, $category[1]);
						echo $data;
					?>
				</select>

			</div>
			


			<p><input type="submit" name="edit" value="Edit"></p>
		</form>
		<h4 class="jumpto">To edit product image <a href="edit_image.php?img=<?php echo $book_id; ?>">Click here</a></h4>
	</div>

<?php

	include('includes/footer.php');

?>
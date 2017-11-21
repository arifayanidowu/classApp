<?php
	
	$page_title = "Add Products";

	include('includes/function.php');

	include('includes/dashboard_header.php');

	include('includes/db.php');
	

	
	$error = [];

	$stmt = $conn->prepare("SELECT * FROM category");
	$stmt -> execute();

	if(array_key_exists('add', $_POST)){
	
		if(empty($_POST['title'])){
			$error['title']= "Please enter Book title";
		}
		if(empty($_POST['author'])){
			$error['author']= "Please enter book author";
		}

		$clean = array_map('trim', $_POST);

		if(empty($_POST['price'])){
			$error['price']= "Please enter book price";
		} else{
			$price = numeric($clean['price']);

			if($price){
				echo "Enter price in digits";
			}
		}
		if(empty($_POST['pub_date'])){
			$error['pub_date'] = "Select the date of publication";
		}
		if(empty($_POST['quantity'])){
			$error['quantity']= "Enter the quantity available";
		}else{
			$quantity = numeric($clean['quantity']);
			if($quantity){
				echo "Enter quantity in digits";
			}
		}
		if(empty($_POST['cat_name'])){
			$error['cat_name']= "Select a category";
		}

		if(empty($error)){
			$row = $stmt->fetch(PDO::FETCH_BOTH);

			$cat_id = $row[0];

			addProduct($conn, $_POST, $cat_id);
			redirect("add_products.php");
		}

	}
?>

<div class="wrapper">
		<h1 id="register-label">Add products</h1>
		<hr>
		<form id="register"  action ="" method ="POST">
			<div>
				<?php 
				$info = displayErrors($error, 'title');
				echo $info;
				?>
				<label>Title:</label>
				<input type="text" name="title" placeholder="Title">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'author');
				echo $info;
				?>
				<label>Author:</label>	
				<input type="text" name="author" placeholder="Author">
			</div>

			<div>
				<?php 
				$info = displayErrors($error, 'price');
				echo $info;
				?>
				<label>Price:</label>
				<input type="text" name="price" placeholder="Price">
			</div>
			<div>
				<?php 
				$info = displayErrors($error, 'pub_date');
				echo $info;
				?>
				<label>publication date:</label>
				<input type="date" name="pub_date" placeholder="Publication date">
			</div>
 
			<div>
				<?php
				$info = displayErrors($error, 'quantity');
				echo $info;
				?>
				<label>Quantity:</label>	
				<input type="text" name="quantity" placeholder="Quantity">
			</div>

			<div>
				
				<label>Category:</label> 
				<select name="cat_name">
					<option>Select Category</option>
					<?php while($row = $stmt->fetch(PDO::FETCH_BOTH)) { ?>
					<option value="<?php echo $row['category_name']; ?>">
						<?php echo $row['category_name']; ?>
					</option>
					<?php } ?>
				</select>

			</div>

			<p><input type="submit" name="add" value="Add"></p>
		</form>
	</div>

	<?php
		include('includes/footer.php');
	?>

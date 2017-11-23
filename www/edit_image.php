<?php
	session_start();
	
	$page_title = "Edit Image";

	include('includes/db.php');

	include('includes/function.php');

	include('includes/dashboard_header.php');

	checkLogin();

	if($_GET['img']){
		$book_id = $_GET['img'];
	}

	$error = [];

	define('MAX_FILE_SIZE', 2097152);

	$ext = ['image/jpeg', 'image/jpg', 'image/png']; // To define the image types

	if(array_key_exists('pic', $_POST)){

		if(empty($_FILES['image']['name'])){
			$error['image']= "Select an image";
		}

		if($_FILES['image']['size'] > MAX_FILE_SIZE){ // To check if the file size is larger than the declared file size above
			$error['image'] = "Image size too large";
		}

		if(!in_array($_FILES['image']['type'], $ext)){
			$error['image'] = "Image type not supported";
		}

		if(empty($error)){
			$img = uploadFile($_FILES, 'image', 'uploads/'); // In uploadFile function, we defined two arrays, one for true and for destination, if true, pass $img[1] into $dest, which is used to validate the file path

			if($img[0]){
				$dest = $img[1];
			}

			updateImage($conn, $book_id, $dest); // the $book_id here is what we declared above, which is meant to be gotten from the URL via $_GET and passed in here to use as a means of locating the particular row in which the image is located in the database, to be edited.

			redirect("view_products.php");

		}


	}


?>
<div class="wrapper">
	<form id="register" action="" method="POST" enctype="multipart/form-data">
		<div>
			<?php
				$info = displayErrors($error, 'image');
						echo $info;
			?>
			<label>Image:</label>
			<input type="file" name="image">
		</div>
		<input type="submit" name="pic" value="Upload">
	</form>	
</div>	

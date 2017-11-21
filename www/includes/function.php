<?php
	function uploadFile($files, $name, $loc){ // passing parameters into uploadFile function
		$result = []; // initializing $result array

		$rnd = rand(0000000000, 9999999999); // to initialize a random number
		$strip_name = str_replace(' ', '_', $files[$name]['name']); // replace white spaces with "underscore _"

		$fileName = $rnd.$strip_name; // concatinate random number and new name
		$destination = $loc.$fileName; // concatinate location and filename to set destination

		if(move_uploaded_file($files[$name]['tmp_name'], $destination)){ // to check if file has been moved
			$result[] = true;

		} else{
			$result[] = false;
		}


		return $result;

	}

	function doAdminRegister($dbconn, $input){
		$hash = password_hash($input['password'], PASSWORD_BCRYPT); // this line is to encrypt the password
		$stmt = $dbconn->prepare("INSERT INTO admin(firstName, lastName, email, hash)
			VALUES(:f, :l, :e, :h)");
		$data = [
			":f" => $input['fname'],
			":l" => $input['lname'],
			":e" => $input['email'],
			":h" => $hash
		];
		$stmt->execute($data);
	}

	function doesEmailExist($dbconn, $email){
		$result = false;

		$stmt = $dbconn->prepare("SELECT email FROM admin WHERE :e=email");

		$stmt->bindParam(":e", $email);

		$stmt->execute();
		$count = $stmt->rowCount();

		if($count > 0){
			$result = true;
		}

		return $result;
	}

	// validation for input errors
	function displayErrors($err, $name){
		$result = "";

		if(isset($err[$name])){
			$result = '<p class="err">'.$err[$name].'</p>';
		}

		return $result;
	}


/*
	function validateLogin($dbconn, $email, $password){
		$result = "";

		$stmt=$dbconn->prepare("SELECT * FROM admin WHERE :e=email");
		$stmt->bindParam(":e", $email);
		$stmt->execute();

		while($fetch=$stmt->fetch(PDO::FETCH_ASSOC)){
			$hash = $fetch['hash'];
			if(password_verify($password, $hash)){
				header("location:home.php");
				$result = true;
			} else{
				$msg = "incorrect email/password";
				header("location:login.php?msg=$msg");
				$result = false;
			}
			return $result;

		}


	}*/


	function adminLogin($dbconn, $input){

		$result = [];

		$stmt = $dbconn->prepare("SELECT * FROM admin WHERE email=:e");

		$stmt->bindParam(":e", $input['email']);

		$stmt->execute();

		$count = $stmt->rowCount();
		$row = $stmt->fetch(PDO::FETCH_BOTH); // Could also use FETCH_BOTH which fetches both the key and value pair

		/*print_r($count); exit();*/ // To check what values or errors you have exit() is to stop the printing

		if($count != 1 || !password_verify($input['password'], $row['hash'])){ //if it's not equal to 1, it means it did not fetch the email from the database {email does not exist}

		$result[] = false;

		} else{
			$result[] = true;
			$result[] = $row;
		}

		return $result;

	}


	function addCategory($dbconn, $input){
		$stmt = $dbconn->prepare("INSERT INTO category(category_name) VALUES(:catName)");

		$stmt->bindParam(':catName', $input['cat_name']);

		$stmt->execute();
	}

	function checkLogin(){
		if(!isset($_SESSION['admin_id'])){
			redirect("login.php");
		}
	}

	function redirect($location, $msg){

		header("Location: ".$location.$msg);
	}




	function viewCategory($dbconn){
		$result = "";

		$stmt = $dbconn->prepare("SELECT * FROM category");

		$stmt->execute();

		while($row = $stmt->fetch(PDO::FETCH_BOTH)){
			$result .= '<tr><td>'.$row[0].'<td>';
			$result .= '<td>'.$row[1].'<td>';
			$result .= '<td><a href="edit_category.php?cat_id='.$row[0].'">edit</a></td>';
			$result .= '<td><a href="delete_category.php?cat_id='.$row[0].'">delete</a></td></tr>';
		}

		return $result;
	}


	function getCategoryById($dbconn, $id){


		$stmt = $dbconn->prepare("SELECT * FROM category WHERE category_id =:catId");

		$stmt->bindParam('catId', $id);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_BOTH);

		return $row;
	}



	function updateCategory($dbconn, $input){

		$stmt = $dbconn->prepare("UPDATE category SET category_name =:catName WHERE category_id =:catID");

		$data = [
			":catName" => $input['cat_name'],
			":catID" => $input['id']
		];

		$stmt->execute($data);
	}



	function curNave($page){

		$curPage = basename($_SERVER['SCRIPT_FILENAME']);

		if($curPage == $page){
			echo 'class="selected"';
		}
	}






?>



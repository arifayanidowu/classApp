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
		$hash = password_hash($input['password'], PASSWORD_BCRYPT);
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

	function displayErrors($err, $name){
		$result = "";

		if(isset($err[$name])){
			$result = '<p class="err">'.$err[$name].'</p>';
		}

		return $result;
	}



	function validateLogin($dbconn, $email, $password){
		$result = "";

		$stmt=$dbconn->prepare("SELECT * FROM admin WHERE :e=email");
		$stmt->bindParam(":e", $email);
		$stmt->execute();

		while($fetch=$stmt->fetch(PDO::FETCH_ASSOC)){
			$hash = $fetch['hash'];
			if(password_verify($password, $hash)){
				$result = true;
			} else{
				$result = false;
			}
			return $result;

		}


	}















?>



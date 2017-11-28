<?php

	class MYSQLIResult{

		private $result;
		const FETCH_ASSOC = 0;
		const FETCH_ARRAY = 1;

		public function __construct($dbconn, $query){

			$this->result = mysqli_query($dbconn, $query) or die(mysqli_error($db));

		}


		public function fetch($method = 0) {
			switch ($method) {
				case 0:
					# code...
					return mysqli_fetch_assoc($this->result); 
					break;
				
				case 1:
					# code...
					return mysqli_fetch_array($this->result); 
					break;
				default:
					# code...
					break;
			}
			
		}
	}


<?php

	class MYSQLIConnection {


		private $dbhost;
		private $dbname;
		private $dbuser;
		private $dbpass;
		private $_db;
		private $result;


		public function __construct() {

			require_once 'config.php';

			extract($config);

			/*echo $dbhost;
			exit();
*/
			$this->_db = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
		}

		public function query($sql){
			$this->result = new MYSQLIResult($this->_db, $sql);

			return $this->result;
		}
	}








?>
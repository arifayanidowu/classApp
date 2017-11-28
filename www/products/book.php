<?php   # book class

	//include 'product.php';

	class Book extends Product implements iDownloadable {

		private $_author;

		/*@override*/
		public function __construct($title, $price, $author){
			$this->_type = "Book";
			$this->_author = $author;
			$this->_title = $title;
			$this->_price = $price;

			// Call an overridden constructor
			//parent::__construct($title, $price);
		}

		/*@override */
		public function getAuthor(){

			return $this->_author;
		}

		// program to an interface not an implementation
		public function getDescription(){
			echo '<ul>';

			echo '<li> type: '.$this->getType().'</li>';
			echo '<li> title: '.$this->getTitle().'</li>';
			echo '<li> price: '.$this->getPrice().'</li>';
			echo '<li> author: '.$this->getAuthor().'</li>';

			echo '</ul>';
		}

		public function prepareDownloadLink(){
			 
		}



	}


?>
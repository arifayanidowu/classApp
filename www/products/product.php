<?php  #product class, defining properties of the product inside code, 
	#An object is an instance of a class...

	abstract class Product{ // when defining classes, they're supposed to be encapsulated, if you wan to modify this, you should define a modifier

		protected $_title; // properties are not supposed to be pre-set
		protected $_price;
		protected $_type; // In PHP it is common to customize a property by locking it down and starting it with an underscore

		//public function __construct(/*$type, */$title, $price) {

				//$this->_title = $title;
				//$this->_price = $price;
				/*$this->_type = $type;*/			

		//}

		// An object is an instance of a class

		function getTitle() {

			return $this->_title;
		}

		// $this is referring to the current class i.e class product
		function setTitle($title){ // To modify a class, set a 
			$this->_title = $title;
		}

		function getPrice(){
			return $this->_price;
		}

		function setPrice($price){
			$this->_price = $price;
		}


		function getType(){
			return $this->_type;
		}

		function setType($type){
			$this->_type = $type;
		}

		abstract public function getDescription();

	}
		




?>
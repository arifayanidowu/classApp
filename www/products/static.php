<?php
	// Anything that is Static does not really belong to the object, you cannot use $this inside a static object
	class Statics { // If a method is static, you don't need to create an instance of the class to call it...
	// before you create a class, create an instance of that class
	// Utility functions should always be static, meaning any object that defines something about an object

		private static $_hourlyRate = 50; // private static count is a class member, statics are class members cos they are not copied and they have one copy of them

		private $name;


		public function __construct(){ 

			#increment counter

			++self::$_hourlyRate; // Everything here is an instance of a class and only one copy of it exist
		}

		public function getCount(){

			return self::$_hourlyRate; // $this can't be used to access a static variable, you can only use self
		}

		public static function doStatic($myname){

			/*$this -> $name = $myname;*/ // Everytime you create an object of a static it becomes a new instance, you cannot be doing object related activity inside a none object context...so DO NOT USE $this to reference it,

		}
	}


		class A {

			const HOURLY_RATE = 50;
		}


		echo A::HOURLY_RATE;

	//$staticInstance = new Statics(); // Everything you call the Static class you implement count

	//$secRef = new Statics();

	//echo $staticInstance->getCount();

	Statics::doStatic("femi");




?>
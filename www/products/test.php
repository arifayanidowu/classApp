<?php
	include 'downloadable.php';
	include 'product.php';
	include 'dvd.php';
	include 'book.php';
	

	// To ccreate a new object, You create an Instance of that class

	//$product = new Product("Book", "Measuring Time", 75);  //  () is called a constructor, This is how to create an instance in PHP, new object, Object is absent here, otherwise, it is a memory, Product is a pointer or a reference referring to the object memory or location of the object in the RAM, Objects are always referenced, they are never copied...That's why it is called object reference
	//$product2 = new Product("Dvd", "Iorigins", 100); // don't use the same object references 

	/*$product->setTitle("Shrek");
*/
	//$productTitle = $product->getTitle();




	//echo $productTitle;

	//echo '<hr/>';

	/*$product2-> setTitle("need for speed");*/

	//$productTitle2 = $product2->getTitle();

	//echo $productTitle2;

	//echo '<hr/>';



	$book = new Book("Book", "Waiting for an angel", 500);

	$bookTitle = $book->getTitle();

	$bookType = $book->getType();

	$bookAuth = $book->getAuthor();

	echo $bookTitle;

	echo "<br>";

	echo $bookType;

	echo "<br>";

	echo $bookAuth;


	$book->getDescription();

	$dvd = new DVD("DVD", "Iorigins", 200);

	$dvdTitle = $dvd->getTitle();

	$dvdType = $dvd->getType();

	$dvdDuration = $dvd->getDuration();

	$dvd->getDescription();



?>
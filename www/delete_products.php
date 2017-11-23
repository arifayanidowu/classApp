<?php
        session_start();

        $page_title = "Delete Product" ;
   		include('includes/function.php');
        include('includes/db.php');


        if($_GET['book_id']) {
            $book_id = $_GET['book_id'];
        }

            deleteProduct($conn, $book_id);

            redirect("view_products.php");

?>
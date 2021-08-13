<?php 
include 'conn.php';

if (isset($_POST['submit'])) {
	$product_name =$_POST['product_name'];
	$product_price =$_POST['product_price'];
	$product_description =$_POST['product_description'];

	$sql= "INSERT INTO product VALUES ('$product_name', '$product_price', '$product_description') ";
	$stmt = $conn->prepare($sql);
	if ($stmt->execute()) {
		echo 'success';
	}else{
		echo 'failed';
	}
}

?>
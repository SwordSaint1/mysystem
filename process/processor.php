<?php
	include 'conn.php';
	$method = $_POST['method'];
	if ($method == 'save') {
		$product_name = $_POST['product_name'];
		$product_price = $_POST['product_price'];
		$product_description = $_POST['product_description'];

		$insert = "INSERT INTO product (`product_name`, `product_price`, `product_description`, `date`) VALUES ('$product_name', '$product_price', '$product_description', '$server_date_only')";
		$stmt = $conn->prepare($insert);
		if($stmt->execute()){
			echo 'success';
		}else{
			echo 'failed';
		}
	}

	if($method == 'fetch_list'){
		$c = 0;
		$fetch = "SELECT *FROM product";
		$stmt = $conn->prepare($fetch);
		$stmt->execute();
		if($stmt->rowCount() > 0){
			foreach($stmt->fetchALL() as $x){
				$c++;
				echo '<tr>';
				echo '<td>'.$c.'</td>';
				echo '<td>'.$x['product_name'].'</td>';
				echo '<td>'.$x['product_price'].'</td>';
				echo '<td>'.$x['product_description'].'</td>';
				echo '<td><button class="btn teal modal-trigger" data-target="modal_view" onclick="get_id_view(&quot;'.$x['id'].'~!~'.$x['product_name'].'~!~'.$x['product_price'].'~!~'.$x['product_description'].'&quot;)">view</button></td>';
				
				echo '<td><button class="btn blue modal-trigger" data-target="modal_edit" onclick="get_id_edit(&quot;'.$x['id'].'~!~'.$x['product_name'].'~!~'.$x['product_price'].'~!~'.$x['product_description'].'&quot;)">edit</button></td>';
				echo '<td><button class="btn red" onclick="get_id('.$x['id'].')">delete</button></td>';
				echo '</tr>';
			}
		}else{
			echo '<tr>';
			echo '<td colspan="3" style="text-align:center;">NO RESULT</td>';
			echo '</tr>';
		}
	}


	if($method == 'delete'){
		$id = $_POST['id'];
		// SQL
		$delete = "DELETE FROM product WHERE id = '$id'";
		$stmt = $conn->prepare($delete);
		if($stmt->execute()){
			echo 'deleted';
		}else{
			echo 'failed';
		}
	}
if($method == 'update_product'){
		$idEdit = $_POST['id'];
		$newProductname = $_POST['newProductname'];
		$newProductprice = $_POST['newProductprice'];
		$newProductdescription = $_POST['newProductdescription'];
		// SQL
		$update = "UPDATE product SET product_name = '$newProductname', product_price = '$newProductprice', product_description = '$newProductdescription' WHERE id = '$idEdit'";
		$stmt = $conn->prepare($update);
		if($stmt->execute()){
			echo 'updated';
		}else{
			echo 'failed';
		}
	}



?>
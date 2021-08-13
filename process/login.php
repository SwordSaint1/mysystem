<?php
 include 'conn.php';
 session_start();
 if (isset($_POST['login_btn'])) {
 	$username = $_POST['username'];
 	$password = $_POST['password'];
 	if (empty($username)) {
 		echo 'Please Enter Username';
 	}else if(empty($password)){
 		echo 'Please Enter Password';
 	}else{

 		$check = "SELECT id,role FROM users WHERE BINARY username = '$username' AND BINARY password = '$password'";
 		$stmt = $conn->prepare($check);
 		$stmt->execute();
 		if ($stmt->rowCount() > 0) {
 			foreach($stmt->fetchALL() as $x){
 				$role = $x['role'];
 				$name = $x['name'];
 			}
 			if($role == 'normal'){
 				$_SESSION['username'] = $username;
 				header('location: page/dashboard.php');
 			}else{
 				$_SESSION['username'] = $username;
 				header('location: page/admin.php');
 			}
 		}else{
 			echo 'Wrong Password';
 		}
 	}
 }
 if (isset($_POST['logout'])) {
 	session_unset();
 	session_destroy();
 	header('location: ../index.php');
 }

?>
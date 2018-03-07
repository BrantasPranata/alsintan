<?php
	include 'config.php';
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:index.php"); }
	else {$username = $_SESSION['username'];}
	
	$adminquery = mysqli_query($con,"SELECT * FROM tb_user WHERE username = '$username'");
	$admin = mysqli_fetch_array($adminquery);
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$nama = $_POST['nama'];
	$phone = $_POST['no_tlep'];
	$alamat = $_POST['alamat'];
	$password = $_POST['password'];
	
	
	
	$updatequery = mysqli_query($con,"UPDATE tb_user SET username = '$username', email = '$email', nama = '$nama', no_tlep = '$phone', alamat = '$alamat', password = '$password' WHERE id_user = '$admin[id_user]'");
	
	if($updatequery){ 
		$adminquery = mysqli_query($con,"SELECT * FROM tb_user WHERE username = '$username'");
		$admin = mysqli_fetch_array($adminquery);
		$user = $admin['username'];
		$_SESSION['username'] = $user;
		header('location:profile.php?error=0');
	}
	else header('location:profile.php?error=1');
	
?>
<?php
	include "config.php";
	//if(isset($_POST['submit'])){
		$username = $_POST['username'];
		$password = $_POST['password'];
		$query = mysqli_query($con,"select * from tb_user where username = '$username' and password = '$password'");
		$data = mysqli_fetch_array($query);
		$user = $data['username'];
		$name = $data['nama'];
		$lat = $data['lat'];
		$lng = $data['lng'];
		$wil  = $data['kode_wil'];
		$pass = $data['password'];
		$hak = $data['hak_akses'];
		$id = $data['id_user'];

		if($username == $user && $password == $pass){
			session_start();
			$_SESSION['hak_akses'] = $hak;
			$_SESSION['username'] = $user;
			$_SESSION['nama']= $name;
			$_SESSION['lat']= $lat;
			$_SESSION['lng']= $lng;
			$_SESSION['wilayah']= $wil;
			$_SESSION['id_user']= $id;
			if($hak == 3){
				header('location:home.php');
			}else if($hak == 2){
				header('location:home.php');
			}else{
				header('location:home.php');
			}

		}
		else{
			header('location:index.php');
		}
	//}
?>
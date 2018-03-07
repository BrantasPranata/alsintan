<?php
$server 	= "localhost";
$username 	= "root";
$password 	= "";
$database 	= "epanen";

// koneksi dan memilih database di server
$con = mysqli_connect ($server, $username,$password,$database)
or die ("koneksi gagal");
?>
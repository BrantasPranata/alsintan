<?php 
  include 'config.php';
  include 'alert.php';
$id = $_GET['id'];
$hak = $_SESSION['hak_akses'];
  
mysqli_query($con,"UPDATE tr_alsintan SET sts=0 WHERE id_tr='$id'")or die(mysqli_error());
 if($hak<3){
header("location:prev_transaksi.php");
writeMsg('update.sukses');
 }
 else {
 header("location:prev_transaksiop.php");
 writeMsg('update.sukses');
 }
?>
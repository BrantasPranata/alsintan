<?php 
  include 'config.php';
  include 'alert.php';
$id = $_GET['id'];
$tgl = $_GET['tgl'];
$has = $_GET['has'];
$pel = $_GET['pel'];
mysqli_query($con,"UPDATE tr_alsintan SET tanggal='$tgl',hasil='$has',pelayanan='$pel' WHERE id_tr='$id'")or die(mysqli_error());
 
header("location:prev_transaksi.php");
writeMsg('update.sukses');
?>
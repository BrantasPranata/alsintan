<?php 
  include 'config.php';
  include 'alert.php';
$id = $_GET['id'];
mysqli_query($con,"UPDATE m_alsintan SET sts=0 WHERE id_al='$id'")or die(mysqli_error());
 
header("location:prev_all.php");
writeMsg('update.sukses');
?>
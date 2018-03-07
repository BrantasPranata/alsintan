<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_tahunal WHERE kd_tahun = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_tahunal.php';</script>";
?>
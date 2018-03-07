<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_sumberdana WHERE kd_sumberdana = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_sumberdana.php';</script>";
?>
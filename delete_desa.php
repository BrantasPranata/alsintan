<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_desa WHERE kd_desa = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_desa.php';</script>";
?>
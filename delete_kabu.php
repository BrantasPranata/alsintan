<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_kab WHERE kd_kab = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_kabu.php';</script>";
?>
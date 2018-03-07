<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_komo WHERE kd_komo = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_komo.php';</script>";
?>
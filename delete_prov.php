<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_prov WHERE kd_prov = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_prov.php';</script>";
?>
<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_status WHERE kd_status = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_status.php';</script>";
?>
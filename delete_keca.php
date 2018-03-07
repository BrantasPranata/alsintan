<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_kec WHERE kd_kec = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_keca.php';</script>";
?>
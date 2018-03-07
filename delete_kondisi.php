<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_kondisi WHERE kd_kondisi = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_kondisi.php';</script>";
?>
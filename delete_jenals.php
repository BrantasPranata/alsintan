<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_jenals WHERE kd_jenals = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_jenals.php';</script>";
?>
<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_pengelolaan WHERE kd_pengelolaan = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_pengelolaan.php';</script>";
?>
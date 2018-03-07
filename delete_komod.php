<?php
include "config.php";

mysqli_query($con,"DELETE FROM tblm_komod WHERE kd_komod = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_komod.php';</script>";
?>
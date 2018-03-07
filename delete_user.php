<?php
include "config.php";

mysqli_query($con,"DELETE FROM tb_user WHERE id_user = '".$_GET['id']."'");
echo "<script language=javascript>parent.location.href='edit_user.php';</script>";
?>
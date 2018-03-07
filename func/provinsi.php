<?php
session_start();
include('login.php');
$login = new Login();
$kdprop = $_GET['prov'];
?>

<option value="">-- Pilih Kabupaten--</option>
<?php 
$p_kab = mysql_query("select * from tb_kabupaten where kd_prop = '$kdprop' order by kd_kab");
while ($h_kab=mysql_fetch_row($p_kab))
{
 echo ("<option value=\"$h_kab[1]\" $str >$h_kab[2]</option>");
}
?>
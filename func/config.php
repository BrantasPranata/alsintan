<?php
define('DB_SERVER', 'localhost');   //define your db server here
define('DB_USERNAME', 'root');      //define your db user here
define('DB_PASSWORD', 'Upsus2016');          //define your db pass here
/*define('DB_SERVER', '132.147.1.43');   //define your db server here
define('DB_USERNAME', 'upsus');      //define your db user here
define('DB_PASSWORD', 'upsus2016');          //define your db pass here*/
define('DB_DATABASE', 'epanen');       //define your db name here
 
class DB_class {
    //put your code here
    function __construct()
    {
        $connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or
        die('Maaf Koneksi Gagal -> ' . mysql_error());
        mysql_select_db(DB_DATABASE, $connection)
        or die('Database error -> ' . mysql_error());
    }
}
?>
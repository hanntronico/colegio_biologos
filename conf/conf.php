<?php 

error_reporting(E_ERROR | E_WARNING | E_PARSE);
date_default_timezone_set('America/Costa_Rica');
setlocale(LC_TIME, "es_ES");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '*274053*');
define('DB_NAME', 'bdcolbiologos');
define('ENLACE_SERVIDOR', 'C://laragon/www/colegio_biologos/');
define('ENLACE_WEB', 'http://127.0.0.1/colegio_biologos/');
define('BOOTSTRAP', 'http://127.0.0.1/colegio_biologos/bootstrap/');


$dbh = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=UTF8', DB_USERNAME, DB_PASSWORD, array(
    PDO::ATTR_PERSISTENT => true, PDO::MYSQL_ATTR_USE_BUFFERED_QUERY => true,
));

 

?>
<?php
include_once("../conf/conf.php");
session_start();
session_destroy();
header('location: '.ENLACE_WEB);
?>
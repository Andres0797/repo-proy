<?php
require $_SERVER['DOCUMENT_ROOT']. '\vendor\autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable($_SERVER['DOCUMENT_ROOT']);
$dotenv->load();


define("MYSQL_USUARIO",getenv("MYSQL_USUARIO"));
define("MYSQL_PASSWORD",getenv("MYSQL_PASSWORD"));
define("MYSQL_SERVIDOR",getenv("MYSQL_SERVIDOR"));
define("MYSQL_BD",getenv("MYSQL_BD"));
?>

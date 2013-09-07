<?php

// Error reporting:
error_reporting(E_ALL ^ E_NOTICE);

ob_start();
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
$title = "Popular Social Forum";
include (ABS_PATH . "/appsec/include/header.php");
require_once (ABS_PATH . "/appsec/include/connect.php");
mysql_query("TRUNCATE TABLE comments");
include (ABS_PATH . "/appsec/include/footer.php");
header('Location: ../client.com');

?>

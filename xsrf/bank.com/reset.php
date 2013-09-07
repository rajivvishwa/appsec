<?php
ob_start();
define("ABS_PATH", $_SERVER['DOCUMENT_ROOT']);
$title = "Popular Social Forum";
include (ABS_PATH . "/appsec/include/header.php");
require_once (ABS_PATH . "/appsec/include/connect.php");
$transfer_query = "Update account set victim=10000, attacker=500";
mysql_query($transfer_query);
include (ABS_PATH . "/appsec/include/footer.php");
header('Location: balance.php');
?>

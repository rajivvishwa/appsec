<?php

// Error reporting:
error_reporting(E_ALL^E_NOTICE);

include "../../connect.php";
mysql_query("TRUNCATE TABLE comments");
header( 'Location: ../client.com' ) ;
  
?>

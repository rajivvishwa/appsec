<?php

include '../../connect.php';
$transfer_query = "Update account set victim=10000, attacker=500";
mysql_query($transfer_query);
header( 'Location: balance.php' ) ;

?>

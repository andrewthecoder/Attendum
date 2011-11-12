<?php
$unid = 3;
$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ';
mt_srand($unid);
for ($p = 0; $p < 6; $p++) {
	$string .= $chars[mt_rand(0, 35)];
}
echo $string;
?>
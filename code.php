<?php
$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ';
$string = 'LEC';
for ($p = 0; $p < 6; $p++) {
	$string .= $chars[mt_rand(0, strlen($chars) – 1)];
}
echo $string;
?>
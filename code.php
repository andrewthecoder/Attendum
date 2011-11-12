<?php
$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ';
$string = 'LEC';
for ($p = 0; $p < 6; $p++) {
	$string .= $chars[srand(0, 35)];
}
echo $string;
?>
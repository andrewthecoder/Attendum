<?php
$cid=1;
$start_time=1321121532;
$end_time=1321122132;
$lid=1;
$seed = intval($cid+$start_time+$end_time+$lid);
echo $seed + '<br /><br />';
$chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWZYZ';
mt_srand($seed);
for ($p = 0; $p < 6; $p++) {
	$string .= $chars[mt_rand(0, 35)];
}
echo $string;
?>
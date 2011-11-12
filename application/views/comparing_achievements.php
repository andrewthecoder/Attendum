<!doctype html>
<head>
<title>
Achievements Comparison
</title>
</head>
<body>
<div id="container">

<?php
$yourEmail = $e1;
echo $users;
echo $users->uid;
echo $users->uid[$yourEmail];
$yourID = $users->uid[$yourEmail];
$yourAchievements = array();

$theirEmail = $e2;
$theirID = $users[$theirEmail]->uid;
$theirAchievements = array();

foreach($userachievements as $ua):
	if($ua->uid == $theirID) array_push($theirAchievements, $ua->aid);
	if($ua->uid == $yourID) array_push($yourAchievements, $ua->aid);
endforeach;

$commonAchievements = array();//achievement ids

foreach($yourAchievements as $a):
	foreach($theirAchievements as $b):
		if($a == $b)
			array_push($commonAchievements, $a);
			array_pull($yourAchievements, $a);
			array_pull($theirAchievements, $b);
	endforeach;
endforeach;
?>

<p>Achievements you have in common</p>
<?php 
foreach($commonAchievements as $ca):
	echo $achievements[$ca]->name;
	echo $achievements[$ca]->description;
endforeach;
?>

<p>Achievements you have that they don't</p>
<?php 
foreach($yourAchievements as $ca):
	echo $achievements[$ca]->name;
	echo $achievements[$ca]->description;
endforeach;
?>

<p>Achievements they have that you don't</p>
<?php 
foreach($theirAchievements as $ca):
	echo $achievements[$ca]->name;
	echo $achievements[$ca]->description;
endforeach;
?>

</div>
</body>
</html>

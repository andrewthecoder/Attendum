<!doctype html>
<head>
<title>
Achievements Comparison
</title>
</head>
<body>
<div id="container">

<?php
if(strlen($error) > 0){echo $error;}

$this->load->model('user_model');

$yourEmail = $e1;
$yourID = $this->user_model->get_uid_using_email($yourEmail);
$yourAchievements = array();

$theirEmail = $e2;
$theirID = $this->user_model->get_uid_using_email($theirEmail);
$theirAchievements = array();

//if(count($userachievements) > 0){
$query = $userachievements->db->query();
foreach($query->result() as $row):
	if($row->uid == $theirID) array_push($theirAchievements, $row->aid);
	if($row->uid == $yourID) array_push($yourAchievements, $row->aid);
endforeach;
//}

$commonAchievements = array();//achievement ids

//f(count($yourAchievements) > 0){
foreach($yourAchievements as $a):
	foreach($theirAchievements as $b):
		if($a == $b)
			array_push($commonAchievements, $a);
			unset($yourAchievements[$a]);
			unset($theirAchievements[$b]);
	endforeach;
endforeach;
?>

<?php 
if(count($commonAchievements) > 0)
{
echo "<p>Achievements you have in common</p>";
foreach($commonAchievements as $ca):
	echo $achievements[$ca]->name;
	echo $achievements[$ca]->description;
endforeach;
}
?>

<?php 
if(count($yourAchievements) > 0)
{
echo "<p>Achievements you have that they don't</p>";
foreach($yourAchievements as $ca):
	echo $achievements[$ca]->name;
	echo $achievements[$ca]->description;
endforeach;
}
?>

<?php
if(count($theirAchievements) > 0)
{
echo "<p>Achievements they have that you don't</p>";
foreach($theirAchievements as $ca):
	echo $achievements[$ca]->name;
	echo $achievements[$ca]->description;
endforeach;
}
?>

</div>
</body>
</html>

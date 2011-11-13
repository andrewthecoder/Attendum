<!doctype html>
<head>
<title>
Achievements Comparison
</title>
</head>
<body>
<div id="container">

<?php
if(strlen($error) > 0){
	echo $error;
}
else
{
	$this->load->model('user_model');

	$yourEmail = $e1;
	$yourID = $this->user_model->get_uid_using_email($yourEmail);
	$yourAchievements = array();

	$theirEmail = $e2;
	$theirID = $this->user_model->get_uid_using_email($theirEmail);
	$theirAchievements = array();

	//if(count($userachievements) > 0){
	$this->load->database('userachievementmodule');
	$query = $this->db->query('SELECT * FROM userachievementmodule');
	foreach($query->result() as $row):
		if($row->uid == $theirID) array_push($theirAchievements, $row->aid);
		if($row->uid == $yourID) array_push($yourAchievements, $row->aid);
	endforeach;
	//}

	$commonAchievements = array();//achievement ids

	//$this->load->model('adm_model');

	if(count($yourAchievements) > 0)
	{
		if(count($theirAchievements) > 0)
		{

			foreach($yourAchievements as $a):
				foreach($theirAchievements as $b):
					if($a == $b)
						array_push($commonAchievements, $a);
						unset($yourAchievements[$a]);
						unset($theirAchievements[$b]);
				endforeach;
			endforeach;
			 
			if(count($commonAchievements) > 0)
			{
			echo "<p>Achievements you have in common</p>";
			foreach($commonAchievements as $ca):
				echo $achievements[$ca]->name;
				echo $achievements[$ca]->description;
				//echo $this->adm_model->achievementString($ca);
			endforeach;
			}

			if(count($yourAchievements) > 0)
			{
			echo "<p>Achievements you have that they don't</p>";
			foreach($yourAchievements as $ca):
				echo $achievements[$ca]->name;
				echo $achievements[$ca]->description;
				//echo $this->adm_model->achievementString($ca);
			endforeach;
			}

			if(count($theirAchievements) > 0)
			{
			echo "<p>Achievements they have that you don't</p>";
			foreach($theirAchievements as $ca):
				echo $achievements[$ca]->name;
				echo $achievements[$ca]->description;
				//echo $this->adm_model->achievementString($ca);
			endforeach;
			}
		}
		else
		{
			echo 'They have no achievements.';
			if(count($yourAchievements) < 1)
			{
				echo 'Your achievements are:';
				foreach($yourAchievements as $ca):
					echo $achievements[$ca]->name;
					echo $achievements[$ca]->description;
					//echo $this->adm_model->achievementString($ca);
				endforeach;
			}
		}
	}
	else
	{
		echo 'You have no achievements.';
		if(count($theirAchievements) < 1)
		{
			echo 'Their achievements are:';
			foreach($theirAchievements as $ca):
				echo $achievements[$ca]->name;
				echo $achievements[$ca]->description;
				//echo $this->adm_model->achievementString($ca);
			endforeach;
		}
	}
}
?>

</div>
</body>
</html>

<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
<?php $this->load->view('inc/header.php'); ?>
<?php

if(strlen($error) > 0)
{
	echo $error;
}
else
{
	$this->load->model('user_model');

	$yourEmail = $e1;
	$yourID = $this->user_model->emailtouid($yourEmail);
	//$yourAchievements = array();

	$theirEmail = $e2;
	$theirID = $this->user_model->emailtouid($theirEmail);
	//$theirAchievements = array();
	
	//echo $yourEmail;
	//echo 'a';
	//echo $theirID;
	//echo 'a';
	//echo $yourID;

	//$this->load->database('userachievementmodule');
	$query = $this->db->query('SELECT a.name AS name, a.description AS description 
	FROM userachievementmodule AS uam LEFT JOIN achievement AS a ON a.aid = uam.aid WHERE uid='.$theirID);
	$theirAchievements = $query->result();
	//foreach($query->result() as $row):
	//	if($row->uid == $theirID){ $theirAchievements[] = $row->aid; }
	//endforeach;
	//echo is_numeric($theirID);
	//echo is_numeric($yourID);
	$query1 = $this->db->query('SELECT a.name AS name, a.description AS description 
	FROM userachievementmodule AS uam LEFT JOIN achievement AS a ON a.aid = uam.aid WHERE uid='.$yourID);
	$yourAchievements = $query1->result();
	//foreach($query->result() as $row):
	//	if($row->uid == $yourID){ $yourAchievements[] = $row->aid; }
	//endforeach;
	$commonAchievements = array();//achievement ids
	//print_r($yourAchievements);
	//print_r($theirAchievements);
	if(!empty($yourAchievements))
	{
		$yourAchievementsCopy = $yourAchievements;
		if(!empty($theirAchievements))
			$theirAchievementsCopy = $theirAchievements;
		{

			foreach($yourAchievements as $a):
				foreach($theirAchievements as $b):
					if($a == $b)
					{
						$commonAchievements[] = $a;
						unset($yourAchievementsCopy[$a]);
						unset($theirAchievementsCopy[$b]);
					}
				endforeach;
			endforeach;
			 
			if(!empty($commonAchievements))
			{
			echo "<p>Achievements you have in common</p>";
			foreach($commonAchievements as $ca):
				echo '<p><li>';
				echo $ca->name;
				echo ' - ';
				echo $ca->description;
				echo '</li></p>';
				//echo "achievementString($ca)";
			endforeach;
			}

			if(!empty($yourAchievementsCopy))
			{
			echo "<p>Achievements you have that they don't</p>";
			foreach($yourAchievementsCopy as $ca):
				echo '<p><li>';
				echo $ca->name;
				echo ' - ';
				echo $ca->description;
				echo '</li></p>';
				//echo "achievementString($ca)";
			endforeach;
			}

			if(!empty($theirAchievementsCopy))
			{
			echo "<p>Achievements they have that you don't</p>";
			foreach($theirAchievementsCopy as $ca):
				echo '<p><li>';
				echo $ca->name;
				echo ' - ';
				echo $ca->description;
				echo '</li></p>';
				//echo "achievementString($ca)";
			endforeach;
			}
		}
		else
		{
			echo '<p>They have no achievements.</p>';
			if(!empty($yourAchievementsCopy))
			{
				echo '<p>Your achievements are:</p>';
				foreach($yourAchievementsCopy as $ca):
					echo '<p><li>';
					echo $ca->name;
					echo ' - ';
					echo $ca->description;
					echo '</li></p>';
					//echo "achievementString($ca)";
				endforeach;
			}
		}
	}
	else
	{
		echo '<p>You have no achievements.</p>';
		if(!empty($theirAchievementsCopy))
		{
			echo '<p>Their achievements are:</p>';
			foreach($theirAchievementsCopy as $ca)
			{
				echo '<p><li>';
				echo $ca->name;
				echo ' - ';
				echo $ca->description;
				echo '</li></p>';
				//echo achievementString($ca);
			}
		}
		else
		{
			echo '<p>They have no achievements.</p>';
		}
	}
}
?>

</div>
<?php $this->load->view('inc/footer.php'); ?>

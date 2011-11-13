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
	function achievementString($aid)
	{
		$this->load->database('achievement');
		$this->db->where('aid', $aid);
		$query = $this->db->get('achievement');
		$row = $query->row_array();
		$name = $row['name'];
		$description = $row['description'];
		$image_filename = base_url()+'images/achievements/'+$row['image_filename'];
		
		$str = '';
		$str .= '<p>';
		$str .= '<img src="'+$image_filename+'" alt"'+$name+'" style="float:right;margin:0 5px 0 0;"/>';
		$str .= $name+'<br/>';
		$str .= $description;
		$str .= '</p>';

		return $str;
	}
	$this->load->model('user_model');

	$yourEmail = $e1;
	$yourID = $this->user_model->emailtouid($yourEmail);
	$yourAchievements = array();

	$theirEmail = $e2;
	$theirID = emailtouid($theirEmail);
	echo $theirID; echo $yourID;
	$theirAchievements = array();
echo count($yourAchievements);
echo count($theirAchievements);
	//if(count($userachievements) > 0){
	$this->load->database('userachievementmodule');
	$query = $this->db->query('SELECT * FROM userachievementmodule');
	foreach($query->result() as $row):
	echo $row->uid;
	echo '=';
	echo $theirID;
	echo '=';
	echo $yourID;
	echo '...';
		if($row->uid == $theirID)
		{
			$theirAchievements[] = $row->aid;
		}
		if($row->uid == $yourID)
		{
			$yourAchievements = $row->aid;
		}
	endforeach;
	//}

echo count($yourAchievements);
echo count($theirAchievements);

	$commonAchievements = array();//achievement ids

	if(count($yourAchievements) > 0)
	{
		if(count($theirAchievements) > 0)
		{

			foreach($yourAchievements as $a):
				foreach($theirAchievements as $b):
					if($a == $b)
					{
						array_push($commonAchievements, $a);
						unset($yourAchievements[$a]);
						unset($theirAchievements[$b]);
					}
				endforeach;
			endforeach;
			 
			if(count($commonAchievements) > 0)
			{
			echo "<p>Achievements you have in common</p>";
			foreach($commonAchievements as $ca):
				//echo $achievements[$ca]->name;
				//echo $achievements[$ca]->description;
				echo "achievementString($ca)";
			endforeach;
			}

			if(count($yourAchievements) > 0)
			{
			echo "<p>Achievements you have that they don't</p>";
			foreach($yourAchievements as $ca):
				//echo $achievements[$ca]->name;
				//echo $achievements[$ca]->description;
				echo "achievementString($ca)";
			endforeach;
			}

			if(count($theirAchievements) > 0)
			{
			echo "<p>Achievements they have that you don't</p>";
			foreach($theirAchievements as $ca):
				//echo $achievements[$ca]->name;
				//echo $achievements[$ca]->description;
				echo "achievementString($ca)";
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
					//echo $achievements[$ca]->name;
					//echo $achievements[$ca]->description;
					echo "achievementString($ca)";
				endforeach;
			}
		}
	}
	else
	{
		echo 'You have no achievements.';
		if(count($theirAchievements) > 0)
		{
			echo 'Their achievements are:';
			foreach($theirAchievements as $ca)
			{
				echo $achievements[$ca]->name;
				echo $achievements[$ca]->description;
				echo achievementString($ca);
			}
		}
		else
		{
			echo 'They have no achievements.';
		}
	}
}
?>

</div>
<?php $this->load->view('inc/footer.php'); ?>

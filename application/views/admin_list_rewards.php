<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Admin Dashboard</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<h2>Current Rewards</h2>
	<?php 
	$yourUniID = $this->session->userdata['unid'];
	$rewards = $this->db->query("SELECT name, description FROM reward WHERE unid =$yourUniID");
	foreach($rewards as $r)
	{
		echo $r['name'];
		echo $r['description'];
	}
	?>
</div>
<?php $this->load->view('inc/footer.php'); ?>

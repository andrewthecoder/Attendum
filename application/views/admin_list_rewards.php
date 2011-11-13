<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Admin Dashboard</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<h2>Current Rewards</h2>
	<?php 
	$yourUniID = $this->session->userdata['unid'];
	$rewards = $this->db->query("SELECT name, description FROM reward WHERE unid =$yourUniID");
	?>
	<table>
	<td>
	<?php foreach($rewards->result() as $r){ ?>
		<tr>{$r->name}</tr>
		<tr>{$r->description}</tr>
	<?php } ?>
	</td>
	</table>
</div>
<?php $this->load->view('inc/footer.php'); ?>

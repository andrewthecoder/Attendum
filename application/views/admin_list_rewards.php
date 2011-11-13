<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Admin Dashboard</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<h2>Current Rewards</h2>
	<?php 
	$yourUniID = $this->session->userdata['unid'];
	$rewards = $this->db->query("SELECT name, description FROM reward WHERE unid =$yourUniID");
	$rows = $rewards->result();
	?>
	<table>
	
	<?php foreach($rows as $r): ?>
	<tr>
		<td><?php echo $r->name ?></td>
		<td><?php echo $r->description ?></td>
	</tr>
	<?php endforeach; ?>
	
	</table>
</div>
<?php $this->load->view('inc/footer.php'); ?>

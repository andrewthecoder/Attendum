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
	<tr>
	<?php foreach($rows as $r): ?>
		<td><?=$r->name?></td>
		<td><?=$r->description?></td>
	<?php endforeach; ?>
	</tr>
	</table>
</div>
<?php $this->load->view('inc/footer.php'); ?>

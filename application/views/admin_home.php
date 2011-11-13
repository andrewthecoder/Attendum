<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<?php
		$admin_rights = $this->session->userdata('admin_rights');
	?>
	<h2>Admin Dashboard</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
</div>
<?php $this->load->view('inc/footer.php'); ?>
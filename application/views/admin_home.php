<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<?php
		$admin_rights = $this->session->userdata('admin_rights');
	?>
	<ul class="pills">
		<?php if($admin_rights >= 1): ?>
			<li><a href="#">Create Code</a></li>
			<li><a href="#">Create Module</a></li>
			<li><a href="#">View Codes</a></li>
		<?php endif; ?>
		<?php if($admin_rights >= 2): ?>
			<li><a href="#">Statistics</a></li>
		<?php endif; ?>
		<?php if($admin_rights >= 3): ?>
		<?php endif; ?>
	</ul>
</div>
<?php $this->load->view('inc/footer.php'); ?>
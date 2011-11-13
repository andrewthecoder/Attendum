<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Create Reward</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<h3>Reward</h3>
	<?php if($this->session->flashdata('add_reward_success') != ''): ?>
				<div class="alert-message success">
				  <a class="close" href="#">×</a>
				  <p><?php echo $this->session->flashdata('add_reward_success'); ?></p>
				</div>
			<?php endif; ?>
				<form action="<?php echo site_url('admin/insert_reward'); ?>" method="post">
					<table>
					<tr>
					<td><label for="username">Name</label></td><td><input type="text" name="name"></td>
					</tr>
					<tr>
					<td><label for="username">Description</label></td><td><input type="text" name="description"></td>
					</tr>
					<tr>
					<td></td><td><input type="submit" name="create" class="btn primary" value="Create"></td>
					</tr>
					</table>
				</form>
</div>
<?php $this->load->view('inc/footer.php'); ?>
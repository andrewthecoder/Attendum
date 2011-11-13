<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	
	<div>
		<h3>Create Module</h3>
			<?php if($this->session->flashdata('module_created') != ''): ?>
				<div class="alert-message success">
				  <a class="close" href="#">×</a>
				  <p><?php echo $this->session->flashdata('module_created'); ?></p>
				</div>
			<?php endif; ?>
			<?php if($this->session->flashdata('invalid_input') != ''): ?>
				<div class="alert-message error">
				  <a class="close" href="#">×</a>
				  <p><?php echo $this->session->flashdata('invalid_input'); ?></p>
				</div>
			<?php endif; ?>
		<form action="<?php echo site_url('admin/submit_module'); ?>" method="post">
			<table>
				<tr>
					<td><label for="name">Module Name</label></td>
					<td><input type="text" name="name" /></td>
				</tr>
				<tr>
					<td><label for="ref">Module Reference</label></td>
					<td><input type="text" name="ref" /></td>
				</tr>
				<tr>
					<td><input type="submit" value="Submit" class="btn primary" /></td>
					<td></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php $this->load->view('inc/footer.php'); ?>
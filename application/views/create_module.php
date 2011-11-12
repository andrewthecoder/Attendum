<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	
	<div>
		<h3>Create Module</h3>
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
					<td><input type="submit" value="Submit" /></td>
					<td></td>
				</tr>
			</table>
		</form>
	</div>
</div>

<?php $this->load->view('inc/footer.php'); ?>
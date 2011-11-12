<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<div class="row">
			<div id="login" class="span6">
				<h3>Add Lecturer</h3>
				<form action="<?php echo site_url('admin/set_lecturer'); ?>" method="post">
					<table>
					<tr>
					<td><label for="username">Email</label></td><td><input type="text" name="email"></td>
					</tr>
					<tr>
					<td></td><td><input type="submit" name="Add" class="btn primary" value="Add"></td>
					</tr>
					</table>
				</form>
			</div>
		<div class="span6">
			<h3>Remove Lecturer</h3>
			<form action="<?php echo site_url('admin/remove_lecturer'); ?>" method="post">
				<table>
				<tr>
				<td><label for="username">Email</label></td><td><input type="text" name="email"></td>
				</tr>
				<tr>
				<td></td><td><input type="submit" name="Remove" class="btn primary" value="Remove"></td>
				</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
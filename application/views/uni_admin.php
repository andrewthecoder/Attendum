<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<div class="row">
		<div class="span10">
			<div id="login" class="span6">
				<h3>Add Lecturer</h3>
				<form action="<?php echo site_url('user/set_lecturer'); ?>" method="post">
					<table>
					<tr>
					<td><label for="username">Email</label></td><td><input type="text" name="email"></td>
					</tr>
					<tr>
					<td></td><td><input type="submit" name="login" class="btn primary" value="Login"></td>
					</tr>
					</table>
				</form>
			</div>
		</div>
		
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
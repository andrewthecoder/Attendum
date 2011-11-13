<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Assign Awards</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<form action="<?php echo site_url('admin/assign_reward'); ?>" method="post">
		<table>
			<tr>
				<td>Achievement</td>
				<td>
					<select name="achievement">
					</select>
				</td>
			</tr>
			<tr>
				<td>Reward</td>
				<td>
					<select name="reward">
					</select>
				</td>
			</tr>
			<tr>
				<td></td>
				<td><input type="submit" name="assign" value="Assign" class="btn primary"></td>
			</tr>
		</table>
	</form>
</div>
<?php $this->load->view('inc/footer.php'); ?>
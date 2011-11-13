<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Assign Awards</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<form action="<?php echo site_url('admin/assign_reward'); ?>" method="post">
		<table>
			<tr>
				<td>Module</td>
				<td>
					<?php echo $module_dropdown; ?>
				</td>
			</tr>
			<tr>
				<td>Achievement</td>
				<td>
					<select name="achievement">
						<?php foreach($achievements as $ach): ?>
							<option value="<?php echo $ach->aid; ?>"><?php echo $ach->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Reward</td>
				<td>
					<select name="reward">
						<?php foreach($rewards as $re): ?>
							<option value="<?php echo $re->rid; ?>"><?php echo $re->name; ?></option>
						<?php endforeach; ?>
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
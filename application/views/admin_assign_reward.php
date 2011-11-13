<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Assign Awards</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<?php if($this->session->flashdata('assign_reward_success') != ''): ?>
		<div class="alert-message success">
			<a class="close" href="#">×</a>
			<p><?php echo $this->session->flashdata('assign_reward_success'); ?></p>
		</div>	
	<?php endif; ?>
	<form action="<?php echo site_url('admin/do_assign_reward'); ?>" method="post">
		<table>
			<tr>
				<td>Module</td>
				<td>
					<select name="mid">
						<?php foreach($modules as $mod): ?>
								<option value="<?php echo $mod->mid; ?>"><?php echo $mod->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Achievement</td>
				<td>
					<select name="aid">
						<?php foreach($achievements as $ach): ?>
							<option value="<?php echo $ach->aid; ?>"><?php echo $ach->name; ?></option>
						<?php endforeach; ?>
					</select>
				</td>
			</tr>
			<tr>
				<td>Reward</td>
				<td>
					<select name="rid">
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
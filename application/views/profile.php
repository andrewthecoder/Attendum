<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Your Profile</h2>
	<h4><strong>Email: </strong><?php echo $this->session->userdata('email'); ?></h4>
	<div class="row">
		<div class="span8">
			<h3>Change Password</h3>
			<form action="<?php echo site_url('user/change_pass'); ?>" method="post">
				<table>
				<tr>
					<td><label for="curr_pass">Current Password</label></td><td><input type="password" name="curr_pass"></td>
				</tr>
				<tr>
					<td><label for="new_pass">New Password</label></td><td><input type="password" name="new_pass"></td>
				</tr>
				<tr>
					<td><label for="new_pass_conf">Confirm New Password</label></td><td><input type="password" name="new_pass_conf"></td>
				</tr>
				<tr>
					<td></td><td><input type="submit" name="submit" value="Change" class="btn primary"></td>
				</tr>
				</table>
			</form>
		</div>
		<div class="span8">
			<?php if($this->session->userdata('opt_in')): ?>
				<form action="<?php echo site_url('user/show_data'); ?>" method="post" style="margin:0 auto;width:200px;">
					<input type="submit" name="hide_my_data" value="Hide My Data" class="btn large primary">
				</form>
			<?php else: ?>
				<form action="<?php echo site_url('user/hide_data'); ?>" method="post" style="margin:0 auto;width:200px;">
					<input type="submit" name="show_my_data" value="Hide My Data" class="btn large primary">
				</form>
			<?php endif; ?>
		</div>
	</div>
	<?php //ACHIEVEMENT LISTINGS GO HERE ?>
	<?php $surl = site_url('user/comparison_chooser'); ?>
	<a href="<?php $surl ?>">Compare achievements.<a/>
</div>
<?php $this->load->view('inc/footer.php'); ?>

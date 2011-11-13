<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>Your Profile</h2>
	<h4><strong>Email: </strong><?php echo $this->session->userdata('email'); ?></h4>
	<h4><strong>Points: </strong><?php echo $points; ?></h4>
	<div class="row">
		<div class="span8">
			<h3>Current Achievements</h3>
			<?php 
			foreach($achievementStrings as $a):
				echo $a->name.' - '.$a->points.'points<br>'; 
			endforeach;
			?>
		</div>
		<div class="span8">
			<h3>Change Password</h3>
			<?php if($this->session->flashdata('change_pw_success') != ''): ?>
				<div class="alert-message success">
				  <a class="close" href="#">×</a>
				  <p><?php echo $this->session->flashdata('change_pw_success'); ?></p>
				</div>
			<?php endif; ?>
			<?php echo validation_errors('<div class="alert-message error"><a class="close" href="#">×</a><p>','</p></div>'); ?>
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
	</div>
	<div class="row">
		<div class="span8">
		
			<h3>Compare Achievements</h3>
			<form action="<?php echo site_url('user/compare_achievements');?>" method="post">
			<p>Enter the email of the person you want to compare achievements with.</p>
			<input type="text" name="e2">
			<input type="submit" value="Go">
			</form>

		</div>
		<div class="span8">
			
			<h3>Controlling Your Data</h3>
			<p>By default all of your data is hidden. That means that all of your achievements and points are hidden from other
			users. By clicking the button below you can toggle whether your data is shared or not. If you choose to share your data
			that means that your achievements and points can be seen by other users for comparisons.</p>
			<p><strong>We never share your email address with another user. They must have it already to compare their achievements with yours.</strong></p>
			<?php if($this->session->userdata('opt_in')): ?>
				<form action="<?php echo site_url('user/hide_data'); ?>" method="post">
					<input type="submit" name="hide_my_data" value="Hide My Data" class="btn large primary">
				</form>
			<?php else: ?>
				<form action="<?php echo site_url('user/show_data'); ?>" method="post">
					<input type="submit" name="show_my_data" value="Show My Data" class="btn large primary">
				</form>
			<?php endif; ?>
		</div>
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>

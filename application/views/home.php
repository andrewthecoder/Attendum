<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<?php echo print_r($this->session->userdata('ip_address')); ?>
	<div class="row">
		<div class="span10">
			<h2>Welcome to Attendum</h2>
			<p>Attendum is a new way to reward students for engaging with their course.</p>
			<div id="login" class="span6">
				<h3>Login</h3>
				<form action="<?php echo site_url('user/login'); ?> method="post">
					<table>
					<tr>
					<td><label for="username">Username</label></td><td><input type="text" name="username"></td>
					</tr>
					<tr>
					<td><label for="password">Password</label></td><td><input type="text" name="password"></td>
					</tr>
					<tr>
					<td></td><td><input type="submit" name="login" class="btn primary" value="Login"></td>
					</tr>
					</table>
				</form>
			</div>
		</div>
		<div class="span6">
			<h3>Sign Up</h3>
			<?php echo validation_errors('<div class="alert-message error"><a class="close" href="#">×</a><p>','</p></div>'); ?>
			<form action="<?php echo site_url('user/signup'); ?>" method="post">
				<table>
				<tr>
					<td>Email</td>
					<td><input type="text" name="email"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="pass"></td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td><input type="password" name="passconf"></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="submit" name="submit" class="btn primary" value="Sign Up"></td>
				</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>
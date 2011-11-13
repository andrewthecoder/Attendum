<!doctype html>
<html>
<head>
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/mobile.css" type="text/css" media="handheld" />
	<title>Check In | Attendum</title>
	<style type="text/css">
		#checkin_body {
			background: #49a2d1;
			font-family: 'Helvetica', 'Arial', sans-serif;
		}

		#checkin h3 {
			font-family: 'Helvetica', 'Arial', sans-serif;
			color: white;
		}

		#checkin p {
			font-family: 'Helvetica', 'Arial', sans-serif;
			color: white;
			width: 100%;
		}
	</style>
</head>
<body id="checkin_body">
	<div id="checkin" class="checkin_div">
		<h3>Attendum Check In</h3>
		<p>Here is where you check into a lecture to register your attendance.
		You might earn an achievement!</p>
		<?php if($this->session->flashdata('achievement_gained') != ''): ?>
			<div class="success">
			  <p><?php echo $this->session->flashdata('achievement_gained'); ?></p>
			</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('checkin_success') != ''): ?>
			<div class="success">
			  <p><?php echo $this->session->flashdata('checkin_success'); ?></p>
			</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('invalid_code') != ''): ?>
			<div class="error">
			  <p><?php echo $this->session->flashdata('invalid_code'); ?></p>
			</div>
		<?php endif; ?>
		<?php if($this->session->flashdata('login_failure') != ''): ?>
			<div class="error">
			  <p><?php echo $this->session->flashdata('login_failure'); ?></p>
			</div>
		<?php endif; ?>
		<form action="<?php echo site_url('checkin/process'); ?>" method="post">
			<table>
			<tr>
			<td><label for="username">Email</label></td><td><input type="text" name="email"></td>
			</tr>
			<tr>
			<td><label for="password">Password</label></td><td><input type="password" name="password"></td>
			</tr>
			<tr>
			<td><label for="code">Code</label></td><td><input type="text" name="code"></td>
			</tr>
			<tr>
			<td></td><td><input type="submit" class="btn primary" value="Check-In!"></td>
			</tr>
			</table>
		</form>
	</div>
	</body>
	</html>
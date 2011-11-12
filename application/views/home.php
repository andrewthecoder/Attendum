<!doctype html>
<head>
<title>
Attendum - Rewarding Your Attendance
</title>
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
</head>
<body>
<div class="container">
	<div>
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
				<td>Confirm Password</td>
				<td><input type="password" name="passconf"></td>
			</tr>
			<tr>
				<td><input type="submit" name="submit" value="Sign Up"></td>
				<td></td>
			</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
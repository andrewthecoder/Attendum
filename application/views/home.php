<!doctype html>
<head>
<title>
Attendum - Rewarding Your Attendance
</title>
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
</head>
<body>
<div id="container">
<?php foreach($user1 as $user): ?>
<p>
Uid:<?php echo $user->uid; ?>
Email:<?php echo $user->email; ?>
<?php $tmp = $user->admin_rights; if($tmp == 0) echo "Admin"; else echo "Not Admin" ?>
Uni uid:<?php echo $user->unid; ?>
Password:<?php echo $user->password; ?>
</p>
<?php endforeach; ?>
<?php foreach($achievement1 as $a): ?>
<p>
Name:<?php echo $a->name; ?>
Points:<?php echo $a->points; ?>
Description:<?php echo $a->description; ?>
</p>
<?php endforeach; ?>
	<div>
		<h3>Sign Up</h3>
		<?php echo validation_errors('<div class="alert-message warning"><a class="close" href="#">×</a><p>','</p></div>'); ?>
		<form action="<?php site_url('user/signup'); ?>" method="post">
			<table>
			<tr>
			<td>Email</td>
			<td><input type="text" name="email"></td>
			</tr>
			<tr>
			<td>Password</td>
			<td><input type="password" name="pass"></td>
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
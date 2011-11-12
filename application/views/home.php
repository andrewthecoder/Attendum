<!doctype html>
<head>
<title>
Attendum - Rewarding Your Attendance
</title>
</head>
<body>
<div id="container">
<?php foreach($user1 as $user): ?>
<p>
<li><?php echo $user->uid; ?></li>
<li><?php echo $user->email; ?></li>
<li><?php echo $user->admin_rights; ?></li>
<li><?php echo $user->unid; ?></li>
<li><?php echo $user->password; ?></li>
</p>
<?php endforeach; ?>
</div>
</body>
</html>
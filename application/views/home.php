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
<li>uid:<?php echo $user->uid; ?></li>
<li>email<?php echo $user->email; ?></li>
<li><?php $tmp = $user->admin_rights; if($tmp == 0) echo "Admin"; else echo "Not Admin" ?></li>
<li>Uni uid:<?php echo $user->unid; ?></li>
<li>Password:<?php echo $user->password; ?></li>
</p>
<?php endforeach; ?>
</div>
</body>
</html>
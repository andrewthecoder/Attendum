<!doctype html>
<head>
<title>
</title>
</head>
<body>
<div id="container">
<?php foreach($user1 as $user): ?>
<p><?php echo $user->email; ?></p>
<?php endforeach; ?>
</div>
</body>
</html>
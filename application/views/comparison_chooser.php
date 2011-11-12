<!doctype html>
<head>
<title>
Achievements Comparison
</title>
</head>
<body>
<div id="container">
<form action="<?php echo site_url('user/compare_achievements');?>" method="post">
/*<p>Your email address</p>
<input type="text" name="e1">
<p>Someone else's email address</p>
<input type="text" name="e2">*/
<p>Enter the email of the person you want to compare achievements with.</p>
<input type="text" name="e2">
<input type="submit" value="Go">
</form>
</div>
</body>
</html>

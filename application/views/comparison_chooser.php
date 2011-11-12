<!doctype html>
<head>
<title>
Achievements Comparison
</title>
</head>
<body>
<div id="container">

<form action="<?php echo site_url('user/compare_achievements');?>" method="POST">
<p>Your email address</p>
<input type="text" name="e1">
<p>Someone else's email address</p>
<input type="text" name="e2">
<input type="submit" value="Go">
</form>
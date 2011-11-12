<!doctype html>
<head>
<title>
Create Code | Attendum
</title>
<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
<link type="text/css" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="Stylesheet" />	
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
<script>
	$(function() {
		$( "#date" ).datepicker({ dateFormat: 'dd-mm-yy' });
	});
</script>
</head>
<body>
<div class="container">
	<div style="padding-top: 30px;">
		<h3>Create Code</h3>
		<form action="<?php echo site_url('admin/submit_code'); ?>" method="post">
			<table>
				<tr>
					<td><label for="module">Module Name</label></td>
					<td><?php echo $module_dropdown ?></td>
				</tr>
				<tr>
					<td><label for="start">Start Date</label></td>
					<td><input type="text" name="date" id="date" /></td>
				</tr>
				<tr>
					<td><input type="submit" value="Submit" /></td>
					<td></td>
				</tr>
			</table>
		</form>
	</div>
</div>
</body>
</html>
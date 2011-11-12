<!doctype html>
<head>
	<title>
	Create Code | Attendum
	</title>
	<link rel="stylesheet" href="http://twitter.github.com/bootstrap/1.4.0/bootstrap.min.css">
	<link type="text/css" href="<?php echo base_url(); ?>css/ui-lightness/jquery-ui-1.8.16.custom.css" rel="Stylesheet" />	
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.0/jquery.min.js"></script>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/jquery-ui-timepicker-addon.js"></script>
	<script>
		$(function() {
			$( "#validfrom" ).datetimepicker({ 
				dateFormat: 'dd/mm/yy',
				separator: ' @ '
			});
			$( "#validtill" ).timepicker();
		});
	</script>
	<style type="text/css">
		/* css for timepicker */
		.ui-timepicker-div .ui-widget-header{ margin-bottom: 8px; }
		.ui-timepicker-div dl{ text-align: left; }
		.ui-timepicker-div dl dt{ height: 25px; }
		.ui-timepicker-div dl dd{ margin: -25px 0 10px 65px; }
		.ui-timepicker-div td { font-size: 90%; }
	</style>
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
						<td><label for="start">Valid From</label></td>
						<td><input type="text" name="validfrom" id="validfrom" /></td>
					</tr>
					<tr>
						<td><label for="start">Valid Till</label></td>
						<td><input type="text" name="validtill" id="validtill" /></td>
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
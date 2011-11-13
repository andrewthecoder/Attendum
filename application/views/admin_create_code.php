<?php $this->load->view('inc/meta.php'); ?>
	<script>
		$(function() {
			$( "#validfrom" ).datetimepicker({ 
				dateFormat: 'dd MM yy',
				separator: ' ',
				stepMinute: 5
			});
			$( "#validity" ).timepicker({
				showHour: false,
				showButtonPanel: false,
				timeFormat: 'm',
				stepMinute: 5,
				minuteMin: 5,
				minuteMax: 60,
				timeOnlyTitle: "Choose Code Validity",
				minuteText: "Minutes"
			});
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

<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
		<div style="padding-top: 30px;">
			<h3>Create Code</h3>
			<?php if($this->session->flashdata('code_created') != ''): ?>
				<div class="alert-message success">
				  <a class="close" href="#">×</a>
				  <p><?php echo $this->session->flashdata('code_created'); ?></p>
				</div>
			<?php endif; ?>
			<?php if($this->session->flashdata('invalid_input') != ''): ?>
				<div class="alert-message error">
				  <a class="close" href="#">×</a>
				  <p><?php echo $this->session->flashdata('invalid_input'); ?></p>
				</div>
			<?php endif; ?>
			<?php if(isset($no_modules) == FALSE): ?>
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
						<td><label for="start">Validity</label></td>
						<td><input type="text" name="validity" id="validity" /></td>
					</tr>
					<tr>
						<td><input type="submit" value="Submit" class="btn primary" /></td>
						<td></td>
					</tr>
				</table>
			</form>
			<?php else: ?>
				<div class="alert-message error">
				  <a class="close" href="#">×</a>
				  <p>No Modules</p>
				</div>
			<?php endif; ?>
		</div>
	</div>
<?php $this->load->view('inc/footer.php'); ?>
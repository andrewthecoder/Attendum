<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>View Codes</h2>
	<?php $this->load->view('inc/admin_nav'); ?>
	<p style="line-height: 30px; font-weight: bold">Key: <span style="background-color: #FFB3B3; padding: 5px 8px;">Expired</span> | <span style="background-color: #B3FFD7; padding: 5px 8px;">Current</span></p>
	<table>
		<tr>
			<td>Code</td>
			<td>Start Date</td>
			<td>Validity</td>
			<td>Module Name</td>
			<td>Module Reference</td>
		</tr>
		<?php echo $htmlrows ?>
	</table>
</div>

<?php $this->load->view('inc/footer.php'); ?>
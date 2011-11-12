<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	
	<div>
		<h3>View Codes</h3>
		<p>Key: <span style="background-color: #FFB3B3">Expired</span> | <span style="background-color: #B3FFD7">Current</span></p>
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
</div>

<?php $this->load->view('inc/footer.php'); ?>
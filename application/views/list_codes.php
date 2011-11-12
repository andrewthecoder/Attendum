<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	
	<div>
		<h3>View Codes</h3>
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
<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<h2>University League Table</h2>
	<div>
		<table>
			<?php echo $htmlout ?>
		</table>
	</div>
	<p></p>
	<h2><i>SMS Testing and Repair</i> League Table</h2>
	<div>
		<table>
			<?php echo $modulehtmlout ?>
		</table>
	</div>
</div>
<?php $this->load->view('inc/footer.php'); ?>

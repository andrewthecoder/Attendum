<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>

	<h1 style="color:green;">Code Created!</h1>
	<p>Code: <?php echo $code ?></p>
	<p>Valid From: <?php echo $startdate ?></p>
	<p></p>
	<p>...Clever boy.</p>
	<a href="<?php echo site_url('admin/'); ?>">Back to Admin</a>
	</div>

<?php $this->load->view('inc/footer.php'); ?>
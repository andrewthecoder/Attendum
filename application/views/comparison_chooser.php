<?php $this->load->view('inc/meta.php'); ?>
<div class="container">
	<?php $this->load->view('inc/header.php'); ?>
	<div class="row">
<form action="<?php echo site_url('user/compare_achievements');?>" method="post">
<p>Enter the email of the person you want to compare achievements with.</p>
<input type="text" name="e2">
<input type="submit" value="Go">
</form>
</div>
<?php $this->load->view('inc/footer.php'); ?>

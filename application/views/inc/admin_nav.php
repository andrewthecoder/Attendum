<ul class="pills">
	<?php
		$admin_rights = $this->session->userdata('admin_rights');
	?>
	<?php if($admin_rights >= 1): ?>
		<li><a href="<?php echo site_url('/admin/create_code'); ?>">Create Code</a></li>
		<li><a href="<?php echo site_url('/admin/create_module'); ?>">Create Module</a></li>
		<li><a href="<?php echo site_url('/admin/list_codes'); ?>">View Codes</a></li>
		<li><a href="<?php echo site_url('/admin/assign_award'); ?>">Assign Award</a></li>
	<?php endif; ?>
	<?php if($admin_rights >= 2): ?>
		<li><a href="<?php echo site_url('/statistics/'); ?>">Statistics</a></li>
		<li><a href="<?php echo site_url('/admin/create_reward'); ?>">Create Reward</a></li>
	<?php endif; ?>
	<?php if($admin_rights >= 3): ?>
	<?php endif; ?>
</ul>
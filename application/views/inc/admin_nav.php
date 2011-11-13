<ul class="pills">
	<?php if($admin_rights >= 1): ?>
		<li><a href="<?php echo site_url('/admin/create_code'); ?>">Create Code</a></li>
		<li><a href="<?php echo site_url('/admin/create_module'); ?>">Create Module</a></li>
		<li><a href="<?php echo site_url('/admin/list_codes'); ?>">View Codes</a></li>
	<?php endif; ?>
	<?php if($admin_rights >= 2): ?>
		<li><a href="<?php echo site_url('/statistics/'); ?>">Statistics</a></li>
	<?php endif; ?>
	<?php if($admin_rights >= 3): ?>
	<?php endif; ?>
</ul>
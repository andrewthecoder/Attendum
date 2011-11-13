			<div id="checkin" class="checkin_div">
				<h3>Check-In!</h3>
				<?php if($this->session->flashdata('checkin_success') != ''): ?>
					<div class="success">
					  <p><?php echo $this->session->flashdata('checkin_success'); ?></p>
					</div>
				<?php endif; ?>
				<?php if($this->session->flashdata('invalid_code') != ''): ?>
					<div class="error">
					  <p><?php echo $this->session->flashdata('invalid_code'); ?></p>
					</div>
				<?php endif; ?>
				<?php if($this->session->flashdata('login_failure') != ''): ?>
					<div class="error">
					  <p><?php echo $this->session->flashdata('login_failure'); ?></p>
					</div>
				<?php endif; ?>
				<form action="<?php echo site_url('checkin/login'); ?>" method="post">
					<table>
					<tr>
					<td><label for="username">Email</label></td><td><input type="text" name="email"></td>
					</tr>
					<tr>
					<td><label for="password">Password</label></td><td><input type="password" name="password"></td>
					</tr>
					<tr>
					<td><label for="code">Code</label></td><td><input type="text" name="code"></td>
					</tr>
					<tr>
					<td></td><td><input type="submit" class="btn primary" value="Check-In!"></td>
					</tr>
					</table>
				</form>
			</div>
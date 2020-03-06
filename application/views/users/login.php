<h2 class="my-5 ml-2"><?=$title?></h2>

<div class="login-form">
	<?php echo form_open('users/login'); ?>
		<div class="form-group">
			<input type="text" name="nif" placeholder="Nif" class="form-control" required>
		</div>

		<div class="form-group">
			<input type="password" name="password" class="form-control" placeholder="Password" required>
		</div>

		<button type="submit" class="btn btn-success float-right mt-3">
			Login
		</button>
	<?php echo form_close(); ?>
</div>
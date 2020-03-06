<h2 class="my-5 ml-2"><?=$title;?></h2>

<?php echo validation_errors(); ?>

<div class="register-form">
	<?php echo form_open('users/register'); ?>
		<div class="form-group">
			<label>Nome</label>
			<input type="text" name="nome" placeholder="Name" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Identificação</label>
			<input type="text" name="identificacao" placeholder="CC/BI" class="form-control">
		</div>
		<div class="form-group">
			<label>Nif</label>
			<input type="text" name="nif" placeholder="Nif" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Telefone</label>
			<input type="text" name="telefone" placeholder="Telefone" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Email</label>
			<input type="email" name="email" placeholder="Email" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Password</label>
			<input type="password" name="password" placeholder="Password" class="form-control" required>
		</div>
		<div class="form-group">
			<label>Confirm Password</label>
			<input type="password" name="password2" placeholder="Password" class="form-control" required>
		</div>

		<button type="submit" class="btn btn-success float-right mt-3">
			Submit
		</button>
	<?php echo form_close(); ?>
</div>
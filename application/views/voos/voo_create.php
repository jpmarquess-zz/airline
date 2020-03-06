<h2 class="my-5"><?=$title;?></h2>

<?php echo form_open('voos/create_voo'); ?>
	<div class="form-group">
		<input type="date" name="data" class="form-control" required>
	</div>

	<div class="form-group">
		<input type="text" name="origem" class="form-control" placeholder="Origem" required>
		</div>

	<div class="form-group">
		<input type="text" name="destino" class="form-control" placeholder="Destino" required>
	</div>

	<button type="submit" class="btn btn-success float-right mt-3">
		Create
	</button>
<?php echo form_close(); ?>
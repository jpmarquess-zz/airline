<h2 class="my-5 ml-2"><?= $title; ?></h2>

<?php echo form_open('voos/create_voo'); ?>
	<div class="from-group">
		<select name="voo_id" class="form-control">
			<?php foreach($voos as $voo) : ?>
				<option value="<?php echo $voo['id']; ?>"><?php echo $voo['data']; ?> | <?php echo $voo['origem'] ?> | <?php echo $voo['destino']; ?></option>
			<?php endforeach; ?>
		</select>

		<button type="submit" class="btn btn-success float-right mt-3">
			Create
		</button>
	</div>
<?php echo form_close(); ?>
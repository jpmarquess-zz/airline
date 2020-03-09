<h2 class="my-5"><?=$title;?></h2>

<?php if(!$voos) : ?>
	<h5 class="mt-5">No results found.</h5>
<?php endif; ?>

<?php if($voos) : ?>
	<?php echo form_open('voos/create_reserva'); ?>
		<div class="from-group">
			<select name="voo_id" class="form-control">
				<option></option>
				
				<?php foreach ($voos as $voo): ?>
					<?php $data = date_create($voo['data']); ?>

					<option value="<?php echo $voo['vooId']; ?>"><?php echo $voo['nVoo']; ?> | <?php echo date_format($data, 'd/m/Y'); ?> | <?php echo $voo['origemNome'] ?> --> <?php echo $voo['destinoNome']; ?></option>
				<?php endforeach;?>
			</select>

			<button type="submit" class="btn btn-success float-right mt-4">
				Create
			</button>
		</div>
	<?php echo form_close(); ?>
<?php endif; ?>
<h2 class="my-5"><?=$title;?></h2>

<?php
	$data = date_create($reserva['created_at']);

	echo "<h5 class='mt-4 mb-3'>Voo Id: " . $reserva['vooId'] . "</h5>";
	echo "<h5 class='mb-3'>Nº Reserva: " . $reserva['nReserva'] . "</h5>";
	echo "<h5 class='mb-3'>Valor: " . $reserva['valor'] . " €</h5>";
	echo "<h5 class='mb-3'>Data: " . date_format($data, 'd/m/Y') . "</h5>";
?>

<?php echo form_open('voos/update/' . $reserva['id']); ?>
	<div class="from-group">
		<select name="voo_id" class="form-control">
			<option></option>

			<?php foreach ($voos as $voo): ?>
				<?php $data = date_create($voo['data']);?>

				<option value="<?php echo $voo['id']; ?>"><?php echo $voo['id']; ?> | <?php echo date_format($data, 'd/m/Y'); ?> | <?php echo $voo['origem'] ?> | <?php echo $voo['destino']; ?></option>
			<?php endforeach;?>
		</select>

		<button type="submit" class="btn btn-success float-right mt-3">
			Create
		</button>
	</div>
<?php echo form_close(); ?>
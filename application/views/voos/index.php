<h2 class="my-5"><?=$title;?></h2>

<?php echo form_open('voos/search'); ?>
	<div class="clearfix">
		<div class="col-lg-6 float-left" id="test">
			<div class="form-group">
				<label>Voo</label>
				<input type="text" name="voo" class="form-control">
			</div>

			<div class="form-group">
				<label>Data do voo</label>
				<input type="date" name="voo-data" class="form-control">
			</div>

			<div class="form-group">
				<label>Origem</label>
				<select name="voo_origem" class="form-control">
					<option></option>

					<?php foreach($origem as $origem) : ?>
						<?php echo "<option value=". $origem['id'] . "> ". $origem['nome'] . "</option>"; ?>
					<?php endforeach; ?>
				</select>
			</div>

			<div class="form-group">
				<label>Destino</label>
				<select name="voo_destino" class="form-control">
					<option></option>
					
					<?php foreach($destino as $destino) : ?>
						<?php echo "<option value=". $destino['id'] . "> ". $destino['nome'] . "</option>"; ?>
					<?php endforeach; ?>
				</select>
			</div>
		</div>

		<div class="col-lg-6 float-right" id="test">
			<div class="form-group">
				<label>Reserva</label>
				<input type="text" name="reserva" class="form-control">
			</div>

			<div class="form-group">
				<label>Nome do Passageiro</label>
				<input type="text" name="passageiro" class="form-control">
			</div>

			<div class="form-group">
				<label>NIF do Passageiro</label>
				<input type="text" name="nif" class="form-control">
			</div>

			<div class="form-group">
				<label>CC/BI</label>
				<input type="text" name="identificacao" class="form-control">
			</div>
		</div>

		<div class="float-right mt-3 mr-3">
			<button type="submit" class="btn btn-info mr-3">
				Pesquisar
			</button>

			<button type="button" class="btn btn-info" id="limpar-form">
				Limpar
			</button>
		</div>
	</div>
<?php echo form_close(); ?>

<?php if (!$voos): ?>
	<h5 class="mt-5">No results found. <a href="<?php echo base_url(); ?>voos/create"> Create Reserva.</a></h5>
<?php endif;?>

<?php if ($voos): ?>
	<div class="table-responsive">
		<table class="table table-bordered text-center my-5">
			<thead>
				<tr>
					<th>Passageiro</th>
					<th>NIF</th>
					<th>Reserva</th>
					<th>Voo</th>
					<th>Data do Voo</th>
					<th>Origem</th>
					<th>Destino</th>
					<th>Valor</th>
					<?php if ($this->session->userdata('logged_in')): ?>
						<th>Actions</th>
					<?php endif;?>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($voos as $voo): ?>
					<tr>
						<?php
							$data = date_create($voo['data']);

							echo "<td class='align-middle'>" . $voo['nome'] . "</td>";
							echo "<td class='align-middle'>" . $voo['nif'] . "</td>";
							echo "<td class='align-middle'>" . $voo['nReserva'] . "</td>";
							echo "<td class='align-middle'>" . $voo['nVoo'] . "</td>";
							echo "<td class='align-middle'>" . date_format($data, 'd/m/Y') . "</td>";
							echo "<td class='align-middle'>" . $voo['origem'] . "</td>";
							echo "<td class='align-middle'>" . $voo['destino'] . "</td>";
							echo "<td class='align-middle'>" . $voo['valor'] . " €</td>";

							if ($this->session->userdata('user_id') == $voo['userId'] || $this->session->userdata('isAdmin')):
								echo "<td>";
								echo "<div class='actions-wrapper'>";
								echo form_open('voos/edit/' . $voo['reservaId']);
								echo "<button type='submit' class='btn btn-info mr-3'>Edit</button>";
								echo form_close();
								echo form_open('voos/delete/' . $voo['reservaId']);
								echo "<button type='submit' class='btn btn-danger'>Delete</button>";
								echo form_close();
								echo "</div>";
								echo "</td>";
							endif;
						?>
					</tr>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
<?php endif;?>
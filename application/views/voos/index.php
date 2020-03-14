<h2 class="my-5"><?=$title;?></h2>

<?php echo form_open('voos/search'); ?>
	<div class="clearfix">
		<div class="col-lg-6 float-left" id="clear-input">
			<div class="form-group">
				<label>Voo</label>
				<input type="text" name="voo" id="search-voo" class="form-control">
			</div>

			<div class="form-group">
				<label>Data do voo</label>
				<input type="date" name="voo-data" class="form-control">
			</div>

			<div class="form-group">
				<label>Origem</label>
				<select name="voo_origem" class="form-control">
					<option></option>

					<?php foreach ($origem as $origem): ?>
						<?php echo "<option value=" . $origem['nome'] . "> " . $origem['nome'] . "</option>"; ?>
					<?php endforeach;?>
				</select>
			</div>

			<div class="form-group">
				<label>Destino</label>
				<select name="voo_destino" class="form-control">
					<option></option>

					<?php foreach ($destino as $destino): ?>
						<?php echo "<option value=" . $destino['nome'] . "> " . $destino['nome'] . "</option>"; ?>
					<?php endforeach;?>
				</select>
			</div>
		</div>

		<div class="col-lg-6 float-right" id="clear-input">
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
			<button type="button" class="btn btn-info" id="limpar-form">
				Limpar
			</button>
		</div>
	</div>
<?php echo form_close(); ?>

<?php if(!$search) : ?>
	<?php if(!$voos) : ?>
		<h5 class="my-5">No reservas found.</h5>
	<?php endif; ?>
<?php endif; ?>

<?php if ($voos) : ?>
	<h3 class="mt-5">Reservas</h3>

	<div class="table-responsive" id="reservas-table">
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
				<?php foreach ($voos as $voo) : ?>
						<?php
							$data = date_create($voo['data']);

							$output = "<tr>";
							$output .= "<td class='align-middle'>" . $voo['userNome'] . "</td>";
							$output .= "<td class='align-middle'>" . $voo['nif'] . "</td>";
							$output .= "<td class='align-middle'>" . $voo['nReserva'] . "</td>";
							$output .= "<td class='align-middle'>" . $voo['nVoo'] . "</td>";
							$output .= "<td class='align-middle'>" . date_format($data, 'd/m/Y') . "</td>";
							$output .= "<td class='align-middle'>" . $voo['origemNome'] . "</td>";
							$output .= "<td class='align-middle'>" . $voo['destinoNome'] . "</td>";
							$output .= "<td class='align-middle'>" . $voo['valor'] . " €</td>";

							if ($this->session->userdata('user_id') == $voo['userId'] || $this->session->userdata('isAdmin')):
								$output .= "<td>";
								$output .= "<div class='actions-wrapper'>";
								$output .= form_open('voos/edit/' . $voo['reservaId']);
								$output .= "<button type='submit' class='btn btn-info mr-3'>Edit</button>";
								$output .= form_close();
								$output .= form_open('voos/delete/' . $voo['reservaId']);
								$output .= "<button type='submit' class='btn btn-danger'>Delete</button>";
								$output .= form_close();
								$output .= "</div>";
								$output .= "</td>";
							endif;

							$output .= "</tr>";

							echo $output;
						?>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php endif; ?>

<?php if ($search) : ?>
	<h3 class="mt-5">Reservas</h3>
	
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
					<?php endif; ?>
				</tr>
			</thead>

			<tbody>
				<?php foreach ($search as $search): ?>
						<?php
							$data = date_create($search['data']);

							$output = "<tr>";
							$output .= "<td class='align-middle'>" . $search['nome'] . "</td>";
							$output .= "<td class='align-middle'>" . $search['nif'] . "</td>";
							$output .= "<td class='align-middle'>" . $search['nReserva'] . "</td>";
							$output .= "<td class='align-middle'>" . $search['nVoo'] . "</td>";
							$output .= "<td class='align-middle'>" . date_format($data, 'd/m/Y') . "</td>";
							$output .= "<td class='align-middle'>" . $search['origemNome'] . "</td>";
							$output .= "<td class='align-middle'>" . $search['destinoNome'] . "</td>";
							$output .= "<td class='align-middle'>" . $search['valor'] . " €</td>";

							if ($this->session->userdata('user_id') == $search['userId'] || $this->session->userdata('isAdmin')):
								$output .= "<td>";
								$output .= "<div class='actions-wrapper'>";
								$output .= form_open('voos/edit/' . $search['reservaId']);
								$output .= "<button type='submit' class='btn btn-info mr-3'>Edit</button>";
								$output .= form_close();
								$output .= form_open('voos/delete/' . $search['reservaId']);
								$output .= "<button type='submit' class='btn btn-danger'>Delete</button>";
								$output .= form_close();
								$output .= "</div>";
								$output .= "</td>";
							endif;

							$output .= "</tr>";

							echo $output;
						?>
				<?php endforeach;?>
			</tbody>
		</table>
	</div>
<?php endif;?>
<h2 class="my-5"><?= $title; ?></h2>

<?php print_r($voos); ?>

<?php echo validation_errors(); ?>

<?php echo form_open(); ?>
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
		    <select name="voo_id" class="form-control">
		    	<option value=""></option>
		    	<option value="fwe">ee</option>
		    	<option value="wef">ee</option>
		    	<option value="wef">ff</option>
		    </select>
		</div>

		<div class="form-group">
			<label>Destino</label>
		    <select name="voo_id" class="form-control">
		    	<option value=""></option>
		    	<option value="fw">ff</option>
		    	<option value="as">aa</option>
		    	<option value="dd">123</option>
		    </select>
		</div>
	</div>

	<div class="col-lg-6 float-right" id="test">
		<div class="form-group">
			<label>Reserva</label>
			<input type="text" name="voo" class="form-control">
		</div>

		<div class="form-group">
			<label>Nome do Passageiro</label>
			<input type="text" name="voo" class="form-control">
		</div>

		<div class="form-group">
			<label>NIF do Passageiro</label>
			<input type="text" name="voo" class="form-control">
		</div>

		<div class="form-group">
			<label>CC/BI</label>
			<input type="text" name="voo" class="form-control">
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
<?php echo form_close(); ?>

<div class="table-responsive">
	<table class="table table-bordered text-center my-5">
		<thead>
			<tr>
				<th style="background-color: #ddddddad;">Passageiro</th>
				<th style="background-color: #ddddddad;">NIF</th>
				<th style="background-color: #ddddddad;">Reserva</th>
				<th style="background-color: #ddddddad;">Voo</th>
				<th style="background-color: #ddddddad;">Data do Voo</th>
				<th style="background-color: #ddddddad;">Origem</th>
				<th style="background-color: #ddddddad;">Destino</th>
				<th style="background-color: #ddddddad;">Valor</th>
				<?php if($this->session->userdata('logged_in')) : ?>
					<th style="background-color: #ddddddad;">Actions</th>
				<?php endif; ?>
			</tr>
		</thead>

		<tbody>
			<?php foreach($voos as $voo) : ?>
				<tr>
					<?php
						$asd = date_create($voo['data']);

						echo "<td>".$voo['nome']."</td>";
						echo "<td>".$voo['nif']."</td>";
						echo "<td>".$voo['nReserva']."</td>";
						echo "<td>".$voo['nVoo']."</td>";
						echo "<td>".date_format($asd, 'd/m/Y')."</td>";
						echo "<td>".$voo['origem']."</td>";
						echo "<td>".$voo['destino']."</td>";
						echo "<td>".$voo['valor']." €</td>";

						if($this->session->userdata('logged_in') && $this->session->userdata('user_id') == $voo['userId']) :
							echo "<td>";
							echo "<div style='display:flex;align-items:center;justify-content:center;'>";
							echo form_open('voos/edit/'.$voo['reserva_id']);
							echo "<button type='submit' class='btn btn-info mr-3'>Edit</button>";
							echo form_close();
							echo form_open('voos/delete/'.$voo['reserva_id']);
							echo "<button type='submit' class='btn btn-danger'>Delete</button>";
							echo form_close();
							echo "</div>";
							echo "</td>";
						endif;
					?>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
</div>
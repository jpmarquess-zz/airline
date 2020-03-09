<h2 class="my-5"><?= $title; ?></h2>

<?php if($reservas) : ?>
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
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($reservas as $reserva) : ?>
                    <?php 
                        $data = date_create($reserva['data']);
                        $output = "<tr>";
                        $output .= "<td class='align-middle'>". $reserva['nome'] ."</td>";
                        $output .= "<td class='align-middle'>". $reserva['nif'] ."</td>";
                        $output .= "<td class='align-middle'>". $reserva['nReserva'] ."</td>";
                        $output .= "<td class='align-middle'>". $reserva['nVoo'] ."</td>";
                        $output .= "<td class='align-middle'>". date_format($data, 'd/m/Y') ."</td>";
                        $output .= "<td class='align-middle'>". $reserva['origemNome'] ."</td>";
                        $output .= "<td class='align-middle'>". $reserva['destinoNome'] ."</td>";
                        $output .= "<td class='align-middle'>". $reserva['valor'] ." €</td>";
                        $output .= "<td>";
                        $output .= "<div class='actions-wrapper'>";
                        $output .= form_open('voos/edit/' . $reserva['reservaId']);
                        $output .= "<button type='submit' class='btn btn-info mr-3'>Edit</button>";
                        $output .= form_close();
                        $output .= form_open('voos/delete/' . $reserva['reservaId']);
                        $output .= "<button type='submit' class='btn btn-danger'>Delete</button>";
                        $output .= form_close();
                        $output .= "</div>";
                        $output .= "</td>";
                        $output .= "</tr>";
                        
                        echo $output;
                    ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>
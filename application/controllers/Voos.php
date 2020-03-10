<?php
class Voos extends CI_Controller
{
    public function index()
    {
        $data['title'] = 'Voo';

        $data['search'] = "";

        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }

        if ($this->session->userdata('isAdmin')) {
            $data['voos'] = $this->voo_model->get_reserva();
            $data['origem'] = $this->voo_model->get_origem();
            $data['destino'] = $this->voo_model->get_destino();
        } else {
            $data['voos'] = $this->voo_model->get_reserva_user($this->session->userdata('user_id'));
            $data['origem'] = $this->voo_model->get_origem();
            $data['destino'] = $this->voo_model->get_destino();
        }

        $this->load->view('templates/header');
        $this->load->view('voos/index', $data);
        $this->load->view('templates/footer');
    }

    public function create()
    {
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }

        $data['title'] = 'Create Reserva';

        $data['voos'] = $this->voo_model->get_voos();

        $this->load->view('templates/header');
        $this->load->view('voos/create', $data);
        $this->load->view('templates/footer');
    }

    // Create reserva
    public function create_reserva()
    {
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }
        
        $nReserva = "EZ" . rand(100, 1000);
        $valor = rand(100, 1000);

        $data = array(
            'userId' => $this->session->userdata('user_id'),
            'vooId' => $this->input->post('voo_id'),
            'nReserva' => $nReserva,
            'valor' => $valor
        );

        $this->db->insert('reserva', $data);

        // Set Message
        $this->session->set_flashdata('create_reserva', 'Reserva was created successfully.');

        redirect('voos');
    }

    // Delete reserva
    public function delete($id)
    {
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }

        $this->voo_model->delete_voo($id);

        $this->session->set_flashdata('reserva_deleted', 'Reserva with id ' . $id . ' has been deleted.');

        redirect('voos');
    }

    // Edit reserva
    public function edit($id)
    {
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }

        $data['test'] = $this->voo_model->gato($this->session->userdata('user_id'));

        if ($data['test'] != $id) {
            $this->session->set_flashdata('login_required', 'ERROR.');

            redirect('voos');
        }

        $data['reserva'] = $this->voo_model->edit_voo($id);
        $data['voos'] = $this->voo_model->get_voos();

        if (empty($data['reserva']) || empty($data['voos'])) {
            show_404();
        }

        $data['title'] = 'Edit Reserva';

        $this->load->view('templates/header');
        $this->load->view('voos/edit', $data);
        $this->load->view('templates/footer');
    }

    // Update reserva
    public function update($id)
    {
        $this->voo_model->update($id);

        $this->session->set_flashdata('edit_reserva', 'Reserva with id: ' . $id . ' was updated successfully.');

        redirect('voos');
    }

    // Search reserva
    public function search()
    {   
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }

        //Retrieve all filters from POST if set
        $search_options['nVoo'] = $this->input->post('voo');
        $search_options['data'] = $this->input->post('voo-data');
        $search_options['origemNome'] = $this->input->post('voo_origem');
        $search_options['destinoNome'] = $this->input->post('voo_destino');
        $search_options['nReserva'] = $this->input->post('reserva');
        $search_options['nome'] = $this->input->post('passageiro');
        $search_options['nif'] = $this->input->post('nif');
        $search_options['identificacao'] = $this->input->post('identificacao');

        $data['search'] = $this->voo_model->search($this->session->userdata('user_id'));

        if(isset($search_options['nVoo']) and !empty($search_options['nVoo'])) {
            $data['search'] = $this->voo_model->search($search_options);
        } 
        if(isset($search_options['data']) and !empty($search_options['data'])) {
            $data['search'] = $this->voo_model->search($search_options);
        }
        if(isset($search_options['origemNome']) and !empty($search_options['origemNome'])) {
            $data['search'] = $this->voo_model->search($search_options);
        }
        if(isset($search_options['destinoNome']) and !empty($search_options['destinoNome'])) {
            $data['search'] = $this->voo_model->search($search_options);
        }
        if(isset($search_options['nReserva']) and !empty($search_options['nReserva'])) {
            $data['search'] = $this->voo_model->search($search_options);
        }
        if(isset($search_options['nome']) and !empty($search_options['nome'])) {
            $data['search'] = $this->voo_model->search($search_options);
        }
        if(isset($search_options['nif']) and !empty($search_options['nif'])) {
            $data['search'] = $this->voo_model->search($search_options);
        }
        if(isset($search_options['identificacao']) and !empty($search_options['identificacao'])) {
            $data['search'] = $this->voo_model->search($search_options);
        }

        $data['voos'] = "";

        $data['origem'] = $this->voo_model->get_origem();
        $data['destino'] = $this->voo_model->get_destino();
        
        $data['title'] = 'Voo';

        $this->load->view('templates/header');
        $this->load->view('voos/index', $data);
        $this->load->view('templates/footer');
    }

    public function voo_create()
    {   
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }

        $data['title'] = 'Create Voo';

        $this->load->view('templates/header');
        $this->load->view('voos/voo_create', $data);
        $this->load->view('templates/footer');
    }

    // Create voo if logged in user is admin
    public function create_voo()
    {   
        // Check if user is logged in
        if (!$this->session->userdata('logged_in')) {
            $this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

            redirect('users/login');
        }

        $n_Voo = "TAP" . rand(100, 1000);
        $vooData = date_create($this->input->post('data'));
        $test = date_format($vooData, "Y-m-d H:i:s");

        // Get valor input da origem e destino e em seguida é guardado o id do record inserido
        $this->db->insert('origem', array("nome" => $this->input->post('origem')));
        $id_origem = $this->db->insert_id();

        $this->db->insert('destino', array("nome" => $this->input->post('destino')));
        $id_destino = $this->db->insert_id();

        $data = array(
            'nVoo' => $n_Voo,
            'data' => $test,
            'origemId' => $id_origem,
            'destinoId' => $id_destino
        );

        $this->db->insert('voo', $data);

        // Set Message
        $this->session->set_flashdata('create_reserva', 'Voo was created successfully.');

        redirect('voos');
    }
}

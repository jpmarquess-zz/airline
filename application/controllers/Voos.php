<?php 
	class Voos extends CI_Controller {
		public function index() {
			$data['title'] = 'Voo';

			$data['voos'] = $this->voo_model->get_reserva();
			
			$this->load->view('templates/header');
			$this->load->view('voos/index', $data);
			$this->load->view('templates/footer');
		}

		public function create() {
			// Check if user is logged in
			if(!$this->session->userdata('logged_in')) {
				$this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

				redirect('users/login');
			}

			$data['title'] = 'Create Reserva';

			$data['voos'] = $this->voo_model->get_voos();

			$this->load->view('templates/header');
			$this->load->view('voos/create', $data);
			$this->load->view('templates/footer');
		}

		public function create_voo() {
			$nReserva = rand(100, 1000);
			$valor    = rand(100, 1000);

			$data = array(
				'userId'   => $this->session->userdata('user_id'),
				'vooId'    => $this->input->post('voo_id'),
				'nReserva' => $nReserva,
				'valor'    => $valor
			);

			$this->db->insert('reserva', $data);

			redirect('voos');
		}

		public function delete($id) {
			// Check if user is logged in
			if(!$this->session->userdata('logged_in')) {
				$this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

				redirect('users/login');
			}

			$this->voo_model->delete_voo($id);

			$this->session->set_flashdata('reserva_deleted', 'Reserva with id '. $id .' has been deleted.');

			redirect('voos');
		}

		public function edit($id) {
			// Check if user is logged in
			if(!$this->session->userdata('logged_in')) {
				$this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

				redirect('users/login');
			}

			/*if($this->session->userdata('user_id') == $data['userId']) {
				$this->session->set_flashdata('login_required', 'You need to be logged in to view that page.');

				redirect('voos');
			}*/

			$data['reserva'] = $this->voo_model->edit_voo($id);
			$data['voos'] = $this->voo_model->get_voos();

			if(empty($data['reserva']) || empty($data['voos'])) {
				show_404();
			}

			$data['title'] = 'Edit reserva';

			$this->load->view('templates/header');
			$this->load->view('voos/edit', $data);
			$this->load->view('templates/footer');
		}

		public function update($id) {
			$this->voo_model->update($id);

			redirect('voos');
		}
	}
 ?>
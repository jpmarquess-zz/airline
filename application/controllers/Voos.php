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
				redirect('users/login');
			}

			$data['title'] = 'Create Voo';

			$data['voos'] = $this->voo_model->get_voos();

			$this->load->view('templates/header');
			$this->load->view('voos/create', $data);
			$this->load->view('templates/footer');
		}

		public function create_voo() {
			$data = array(
				'userId' => $this->session->userdata('user_id'),
				'vooId' => $this->input->post('voo_id'),
				'nReserva' => 399,
				'valor' => 220
			);

			return $this->db->insert('reserva', $data);

			redirect('voos');
		}

		public function delete($id) {
			$this->voo_model->delete_voo($id);

			$this->session->set_flashdata('voo_deleted', 'Voo with id '. $id .' has been deleted.');

			redirect('voos');
		}

		public function edit($id) {
			$data['voos'] = $this->voo_model->edit_voo($id);

			if(empty($data['voos'])) {
				show_404();
			}

			$data['title'] = 'Edit Voo';

			$this->load->view('templates/header');
			$this->load->view('voos/edit', $data);
			$this->load->view('templates/footer');
		}
	}
 ?>
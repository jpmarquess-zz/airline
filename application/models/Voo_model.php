<?php
	class Voo_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

		// Join das tabela reserva, users e voo
		public function get_reserva() {
			$this->db->join('users', 'users.id = reserva.userId');
			$this->db->join('voo', 'voo.id = reserva.vooId');
			$query = $this->db->get('reserva');

		    if($query->num_rows() != 0) {
		        return $query->result_array();
		    } else {
		        return false;
		    }
		}

		// Criar Reserva
		public function get_voos() {
			$query = $this->db->get('voo');

			return $query->result_array();
		}

		// Delete reserva
		public function delete_voo($id) {
			$this->db->where('reserva_id', $id);
			$this->db->delete('reserva');

			return true;
		}

		// Edit da reserva
		public function edit_voo($id) {
			$query = $this->db->get_where('reserva', array('reserva_id' => $id));
			
			return $query->row_array();
		}

		// Update reserva
		public function update($id) {
			$data = array(
				'vooId' => $this->input->post('voo_id')
			);

			$this->db->where('reserva_id', $id);

			return $this->db->update('reserva', $data);
		}
	}
 ?>
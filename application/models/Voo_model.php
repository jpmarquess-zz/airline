<?php
	class Voo_model extends CI_Model {
		public function __construct() {
			$this->load->database();
		}

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

		public function get_voos() {
			$query = $this->db->get('voo');
			return $query->result_array();
		}

		public function delete_voo($id) {
			$this->db->where('reserva_id', $id);
			$this->db->delete('reserva');

			return true;
		}

		public function edit_voo($id) {
			$query = $this->db->get_where('voo', array('id' => $id));
			return $query->row_array();
		}
	}
 ?>
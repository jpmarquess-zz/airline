<?php
class Voo_model extends CI_Model
{
    public function __construct()
    {
        $this->load->database();
    }

    // Join das tabela reserva, users e voo
    public function get_reserva()
    {
        $this->db->select(
            'reserva.id as reservaId, reserva.userId, reserva.vooId, reserva.nReserva, reserva.valor, reserva.created_at,
            users.id, users.nome as userNome, users.nif,
            voo.id, voo.nVoo, voo.data, voo.created_at,
            origem.id, origem.nome as origemNome,
            destino.id, destino.nome as destinoNome'
        );
        $this->db->join('users', 'users.id = reserva.userId');
        $this->db->join('voo', 'voo.id = reserva.vooId');
        $this->db->join('origem', 'origem.id = voo.origemId');
        $this->db->join('destino', 'destino.id = voo.destinoId');
        $this->db->order_by('reserva.valor', 'DESC');
        $query = $this->db->get('reserva');

        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_origem()
    {
        $this->db->select('nome');
        $this->db->distinct();
        $query = $this->db->get('origem');

        return $query->result_array();
    }

    public function get_destino()
    {
        $this->db->select('nome');
        $this->db->distinct();
        $query = $this->db->get('destino');
    
        return $query->result_array();
    }

    // Criar Reserva
    public function get_voos()
    {
        $this->db->select(
            'voo.id as vooId, voo.nVoo, voo.data, voo.origemId, voo.destinoId,
            origem.id, origem.nome as origemNome,
            destino.id, destino.nome as destinoNome'
        );
        $this->db->join('origem', 'origem.id = voo.origemId');
        $this->db->join('destino', 'destino.id = voo.destinoId');
        $query = $this->db->get('voo');
        
        return $query->result_array();
    }

    // Delete reserva
    public function delete_voo($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('reserva');
        return true;
    }

    // Edit da reserva
    public function edit_voo($id)
    {
        $query = $this->db->get_where('reserva', array('id' => $id));

        return $query->row_array();
    }

    // Update reserva
    public function update($id)
    {
        $data = array(
            'vooId'      => $this->input->post('voo_id'),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $this->db->where('id', $id);

        return $this->db->update('reserva', $data);
    }

    // Get dados da reserva através do id do user
    public function get_reserva_user($user_id)
    {
        $this->db->select(
            'reserva.id as reservaId, reserva.userId, reserva.vooId, reserva.nReserva, reserva.valor, reserva.created_at,
            users.id, users.nome as userNome, users.nif,
            voo.id, voo.nVoo, voo.data, voo.created_at,
            origem.id, origem.nome as origemNome,
            destino.id, destino.nome as destinoNome'
        );
        $this->db->join('users', 'users.id = reserva.userId');
        $this->db->join('voo', 'voo.id = reserva.vooId');
        $this->db->join('origem', 'origem.id = voo.origemId');
        $this->db->join('destino', 'destino.id = voo.destinoId');
        $this->db->order_by('reserva.valor', 'DESC');
        $query = $this->db->get_where('reserva', array('userId' => $user_id));

        return $query->result_array();
    }

    // Search pelo número do voo
    public function search($search_options)
    {
        $data = array();

        if(!$this->session->userdata('isAdmin')) {
            $data = array("userId" => $this->session->userdata('user_id'));
        }

        if(!empty($search_options['nVoo'])) {
            $data['nVoo'] = $search_options['nVoo'];
        }
        if(!empty($search_options['data'])) {
            $data['data'] = $search_options['data'];
        }
        if(!empty($search_options['origemNome'])) {
            $data['origem.nome'] = $search_options['origemNome'];
        }
        if(!empty($search_options['destinoNome'])) {
            $data['destino.nome'] = $search_options['destinoNome'];
        }
        if(!empty($search_options['nReserva'])) {
            $data['nReserva'] = $search_options['nReserva'];
        }
        if(!empty($search_options['nome'])) {
            $data['users.nome'] = $search_options['nome'];
        }
        if(!empty($search_options['nif'])) {
            $data['nif'] = $search_options['nif'];
        }
        if(!empty($search_options['identificacao'])) {
            $data['identificacao'] = $search_options['identificacao'];
        }

        $this->db->select(
            'reserva.id as reservaId, reserva.userId, reserva.nReserva, reserva.valor,
            users.id, users.nome, users.nif, users.identificacao,
            voo.id, voo.nVoo, voo.data,
            origem.id, origem.nome as origemNome,
            destino.id, destino.nome as destinoNome'
        );
        $this->db->join('users', 'users.id = reserva.userId');
        $this->db->join('voo', 'voo.id = reserva.vooId');
        $this->db->join('origem', 'origem.id = voo.origemId');
        $this->db->join('destino', 'destino.id = voo.destinoId');
        $this->db->order_by('reserva.valor', 'DESC');
        $query = $this->db->get_where('reserva', $data);

        return $query->result_array();
    }

    public function gato($id) {
        $this->db->select(
            'reserva.id as reservaId, reserva.userId, reserva.vooId, reserva.nReserva, reserva.valor, reserva.created_at,
            users.id as catId, users.nome as userNome, users.nif,
            voo.id as vooId, voo.nVoo, voo.data, voo.created_at,
            origem.id, origem.nome as origemNome,
            destino.id, destino.nome as destinoNome'
        );
        $this->db->join('users', 'users.id = reserva.userId');
        $this->db->join('voo', 'voo.id = reserva.vooId');
        $this->db->join('origem', 'origem.id = voo.origemId');
        $this->db->join('destino', 'destino.id = voo.destinoId');
        $this->db->order_by('reserva.valor', 'DESC');
        $query = $this->db->get_where('reserva', array('userId' => $id));

        if ($query->num_rows() != 0) {
            return $query->row()->reservaId;
        } else {
            return false;
        }
    }
}

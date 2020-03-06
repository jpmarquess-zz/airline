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
            users.id, users.nome, users.nif,
            voo.voo_id, voo.nVoo, voo.data, voo.created_at'
        );
        $this->db->join('users', 'users.id = reserva.userId');
        $this->db->join('voo', 'voo.voo_id = reserva.vooId');
        $query = $this->db->get('reserva');

        if ($query->num_rows() != 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }

    public function get_origem()
    {
        $query = $this->db->get('origem');

        return $query->result_array();
    }

    public function get_destino($id)
    {
        if(!$id) {
            $query = $this->db->get_where('destino');
    
            return $query->result_array();
        }
    }

    // Criar Reserva
    public function get_voos()
    {
        $this->db->select(
                'voo.voo_id as bla, voo.nVoo, voo.data,
                origem.origem_id, origem.nome,
                destino.destino_id, destino.nome'
        );
        $this->db->from('voo');
        $this->db->join('origem', 'origem.origem_id = voo.origemId');
        $this->db->join('destino', 'destino.destino_id = voo.destinoId');
        $query = $this->db->get();
        
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
            'vooId' => $this->input->post('voo_id'),
            'updated_at' => date("Y-m-d H:i:s")
        );

        $this->db->where('id', $id);

        return $this->db->update('reserva', $data);
    }

    // Get dados da reserva através do id do user
    public function get_reserva_user($user_id)
    {
        $this->db->join('users', 'users.id = reserva.userId');
        $this->db->join('voo', 'voo.id = reserva.vooId');
        $query = $this->db->get_where('reserva', array('userId' => $user_id));

        return $query->result_array();
    }

    // Search pelo número do voo
    public function search($search_options)
    {

        // if(!empty($search_options["voo"])){
        //     $this->db->where('voo.numero',$search_options["voo"]);
        // }

        // if(!empty($search_options["voo"]){
        //     $this->db->where('voo.numero',$search_options["voo"]);
        // }

        // if(!empty($search_options["voo"]){
        //     $this->db->where('voo.numero',$search_options["voo"]);
        // }

        // if(!empty($search_options["voo"]){
        //     $this->db->where('voo.numero',$search_options["voo"]);
        // }

        // $voo = $this->input->post('voo');
        // $data = $this->input->post('voo-data');

        // if($voo) {
        //     $data = array(
        //         "userId" => $user_id,
        //         "nVoo" => $voo
        //     );
    
        //     $this->db->join('users', 'users.id = reserva.userId');
        //     $this->db->join('voo', 'voo.id = reserva.vooId');
        //     $query = $this->db->get_where('reserva', $data);

        //     return $query->result_array();
        // } else if($data) {
        //     $data = array(
        //         "userId" => $user_id,
        //         "data" => $data
        //     );
    
        //     $this->db->join('users', 'users.id = reserva.userId');
        //     $this->db->join('voo', 'voo.id = reserva.vooId');
        //     $query = $this->db->get_where('reserva', $data);

        //     return $query->result_array();
        // }
        
        $data = array(
            "userId" => $this->session->userdata('user_id'),
            "data" => $data
        );

        $this->db->join('users', 'users.id = reserva.userId');
        $this->db->join('voo', 'voo.id = reserva.vooId');
        $query = $this->db->get_where('reserva', $data);

        return $query->result_array();
    }
}

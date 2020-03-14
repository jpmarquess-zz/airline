<?php
class User_model extends CI_Model
{
    public function register($enc_password)
    {
        // User data array
        $data = array(
            'nome'          => $this->input->post('nome'),
            'identificacao' => $this->input->post('identificacao'),
            'nif'           => $this->input->post('nif'),
            'telefone'      => $this->input->post('telefone'),
            'email'         => $this->input->post('email'),
            'password'      => $enc_password,
            'isAdmin'       => false,
        );

        // Create user
        return $this->db->insert('users', $data);
    }

    // Login
    public function login($nif, $password)
    {
        // Validate
        $this->db->where('nif', $nif);
        $this->db->where('password', $password);

        $result = $this->db->get('users');

        if ($result->num_rows() == 1) {
            return $result->row(0)->id;
        } else {
            return false;
        }
    }

    // Check if nif exists
    public function check_nif_exists($nif)
    {
        $query = $this->db->get_where('users', array('nif' => $nif));

        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    // Check if email exists
    public function check_email_exists($email)
    {
        $query = $this->db->get_where('users', array('email' => $email));

        if (empty($query->row_array())) {
            return true;
        } else {
            return false;
        }
    }

    // Check if user is admin
    public function check_admin($user_id)
    {
        $this->db->where('id', $user_id);
        $result = $this->db->get('users');
        
        if ($result->num_rows() == 1) {
            return $result->row(0)->isAdmin;
        } else {
            return false;
        }
    }
}

<?php
	class Users extends CI_Controller {
		// Signup
		public function register() {
			$data['title'] = 'Signup';

			$this->form_validation->set_rules('nome', 'Nome', 'required');
			$this->form_validation->set_rules('identificacao', 'Identificacao', 'required');
			$this->form_validation->set_rules('nif', 'Nif', 'required|callback_check_nif_exists');
			$this->form_validation->set_rules('telefone', 'Telefone', 'required');
			$this->form_validation->set_rules('email', 'Email', 'required|callback_check_email_exists');
			$this->form_validation->set_rules('password', 'Password', 'required');
			$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

			if($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('users/register', $data);
				$this->load->view('templates/footer');
			} else {
				// Encrypt password
				$enc_password = hash('sha256', $this->input->post('password'));

				$this->user_model->register($enc_password);

				// Set message
				$this->session->set_flashdata('user_registered', 'You are now registered and can login.');

				redirect('users/login');
			}
		}

		// Login
		public function login() {
			$data['title'] = 'Login';

			$this->form_validation->set_rules('nif', 'Nif', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() === FALSE) {
				$this->load->view('templates/header');
				$this->load->view('users/login', $data);
				$this->load->view('templates/footer');
			} else {
				// Get login info
				$nif = $this->input->post('nif');
				// Get and encrypt the password
				$password = hash('sha256', $this->input->post('password'));

				// Login user
				$user_id = $this->user_model->login($nif, $password);

				if($user_id) {
					// Create session
					$user_data = array(
						'user_id' => $user_id,
						'username' => $username,
						'logged_in' => true
					);

					$this->session->set_userdata($user_data);

					// Set message
					$this->session->set_flashdata('user_loggedin', 'You are now logged in.');

					redirect('voos');
				} else {
					// Set message
					$this->session->set_flashdata('login_failed', 'Login is invalid.');

					redirect('users/register');
				}
			}
		}

		// Logout
		public function logout() {
			// Unset user data
			$this->session->unset_userdata('user_id');
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('logged_in');

			// Set message
			$this->session->set_flashdata('user_loggedout', 'You are now logged out.');

			redirect('users/login');
		}

		// Check if nif exists
		public function check_nif_exists($if) {
			$this->form_validation->set_message('check_nif_exists', 'That nif has already been registered in our database. Try to login instead.');

			if($this->user_model->check_nif_exists($if)) {
				return true;
			} else {
				return false;
			}
		}

		// Check if email exists
		public function check_email_exists($email) {
			$this->form_validation->set_message('check_email_exists', 'That email is already taken.');

			if($this->user_model->check_email_exists($email)) {
				return true;
			} else {
				return false;
			}
		}
	}
?>
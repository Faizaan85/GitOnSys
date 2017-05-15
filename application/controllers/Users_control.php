<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class users_control extends CI_Controller{

	public function __construct()
	{
		parent::__construct();
		//Codeigniter : Write Less Do More
	}

	public function register()
	{
		$data['title'] = 'Sign up';
		$this->form_validation->set_rules('name', 'Name', 'required');
		$this->form_validation->set_rules('username', 'Username', 'required|callback_check_username');
		$this->form_validation->set_rules('email', 'Email', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'matches[password]');

		if ($this->form_validation->run() === FALSE) {
			// Means the Validations rules had error.

			$this->load->view('logins/register',$data);

		} else {
			// Validations passed.
			// Encrypt password
			$enc_password = md5($this->input->post('password'));
			$this->load->model('user_model');
			$result = $this->user_model->register($enc_password);
			if($result == '1')
			{
				// There was some result
				$this->session->set_flashdata('user_registered', 'You are now registered. Please check your email for confirmation!');
				redirect('login');
			}
			else
			{
				// No result. possibly database error.
				die('something needs to be here');
			}
		}

	}
	public function login()
	{
		$data['title'] = 'Login';
		$this->form_validation->set_rules('username', 'Username', 'required');
		$this->form_validation->set_rules('password', 'Password', 'required');

		if($this->form_validation->run() === FALSE)
		{
			// Means validation rules faild or not yet run
			$this->load->view('logins/login', $data);
		}
		else
		{
			// Means validation successful,
			// Need to MD5 the password and send to user model
			$enc_password = md5($this->input->post('password'));
			$this->load->model('user_model');
			// Check credentials in database and get user details if true.
			$result = $this->user_model->login($enc_password);
			// Check result
			if($result != NULL)
			{
				// Set session userdata
				$data = array(
					'username' => $result[0]['UsrUsername'],
					'level' => $result[0]['UsrLevel'],
					'storelevel' => $result[0]['UsrStoreLevel'],
					'logged_in' => TRUE
				);
				// Set Session
				$this->session->set_userdata($data);
				// Redirect to main page.
				redirect('home');

			}
			else
			{
				$this->session->set_flashdata('login_failed','Invalid Username or Password');
				redirect('login');
			}
		}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
// Callback functions
	function check_username($username) //this variable is the same as the first argument in the validation rules
	{
		$this->form_validation->set_message('check_username','That username is taken. Please choose a different one');
		$this->load->model('user_model');
		if($this->user_model->check_username($username))
		{
			return true;
		}
		else
		{
			return false;
		}
	}

}
?>

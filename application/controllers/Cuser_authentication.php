<?php
session_start();

Class Cuser_Authentication extends CI_Controller
{
	
	public function __construct()
	{
		parent::__construct();

		// Load Libraries
		$this->load->helper('form');
		$this->load->library('form_validation');
		// $this->load->helper('form_validation');
		$this->load->library('session');

		// Load Model
		$this->load->model('login_model');
	}

	//show login page
	public function index()
	{
		$this->load->view('login_form');
	}

	//show registration page
	public function user_registration_show()
	{
		$this->load->view('registration_form');
	}

	//validate and store registration data in database
	public function new_user_registration() 
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('email_value', 'Email', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('registration_form');
		}
		else
		{
			$data = array
			(
				'user_name' => $this->input->post('username'),
				'user_email' => $this->input->post('email_value'),
				'user_password' => $this->input->post('password')
			);
			$result = $this->login_model->registration_insert($data);
			if($result == TRUE) 
			{
				$data['message_display'] = 'Registration Successfull!';
				$this->load->view('login_form',data);
			}
			else
			{
				$data['message_display'] = 'Username already exist!';
				$this->load->view('registration_form',$data);
			}
		}
	}

	//check for user login process
	public function user_login_process()
	{
		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
		if ($this->form_validation->run() == FALSE) 
		{
			if(isset($this->session_userdata['logged_in']))
			{
				$this->load->view('admin_page');
			}
			else
			{
				$this->load->view('login_form');
			}
			
		} 
		else 
		{
			$data = array
			(
				'username' => $this->input->post('username'),
				'pasword' => $this->input->post('password')
			);
			$result = $this->login_model->login($data);
			if($result == TRUE)
			{
				$result = $this->login_model->read_user_information($data['username']);
				if($result != FALSE)
				{
					$session_data = array
					(
						'username' =>$result[0]->user_name,
						'email' => $result[0]->user_email,
					);
					// Add user data in session
					$this->session->userdata('logged_in',$session_data);
					$this->load->view('admin_page');
				}
			}
			else
			{
				$data = array
				(
					'error_message' => 'Invalid Username or Password'
				);
				$this->load->view('login_form', $data);
			}
		}
	}
// Logout from admin page
	public function logout()
	{
		// Removing session data
		$sess_array = array
		(
			'username' => ''
		);
		$this->session->unset_userdata('logged_in',$sess_array);
		$data['message_display'] = "Logout Successfull";
		$this->load->view('login_form', $data);
	}
}
?>
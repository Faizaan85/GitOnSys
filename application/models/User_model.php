<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();

	}
	public function register($enc_password)
	{
		// Data Array
		$data = array(
			'UsrName' => $this->input->post('name'),
			'UsrEmail' => $this->input->post('email'),
			'UsrUsername' => $this->input->post('username'),
			'UsrPassword' => $enc_password
		);
		// Insert user
		return $this->db->insert('users', $data);
	}
	public function login($enc_password)
	{
		// Data Array
		$data = array(
			'UsrUsername' =>  $this->input->post('username'),
			'UsrPassword' => $enc_password
		);
		$this->db->select('UsrUsername, UsrLevel');
		$result = $this->db->get_where('users', $data, 1);
		return $result->result_array();
	}
	public function check_username($username)
	{
		$query = $this->db->get_where('users', array('UsrUsername' => $username));
		// Check if $query return any rows. $query will have a lot more details, so have to check ->row_array()
		if(empty($query->row_array()))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public function get_userid($username)
	{
		$query = $this->db->get_where('users', array('UsrUsername' => $username));
		if(empty($query->row_array()))
		{
			return false;
		}
		else
		{
			return $query->row_array();
		}
	}

}

/* End of file user_model.php */
/* Location: ./application/models/user_model.php */

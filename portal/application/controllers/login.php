<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	private function _login()
	{
		$user = query_from_param('sysUser', array('username', 'password'), TRUE);
		if (!$user)
		{
			return FALSE;
		}
		$this->mongo_db->where(array('username' => $user['username']))->update('sysUser', array('last_login_ip' => $this->input->ip_address(), 'last_login_time' => new MongoDate(time())));
		set_login($user);
		return TRUE;
	}
	
	public function attempt()
	{
		if ($this->_login())
		{
			echo json_encode(array('success' => 1));
		}
		else
		{
			echo json_encode(array('success' => 0));
		}
	}
	
	public function index()
	{
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)
		{
			$this->load->view('not_supported');
			return;
		}
		$this->load->view('login');
	}
}

/* End of file */
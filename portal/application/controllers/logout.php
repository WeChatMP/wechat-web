<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Logout extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user = get_login();
		
		if (!$this->user)
		{
			header('Location: ' . site_url('/login'));
			die;
		}
	}
	
	public function index()
	{
		clear_login();
		echo '<script type="text/javascript">logout();</script>';
	}
}

/* End of file */
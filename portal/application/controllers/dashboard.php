<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
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
		ac_check('dashboard', 2);
		$this->load->view('dashboard');
	}
}

/* End of file */
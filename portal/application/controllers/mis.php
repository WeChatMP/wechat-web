<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mis extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user = get_login();
		
		if (!$this->user)
		{
			ajax_login();
		}
	}
	
	public function index()
	{
		ac_check('mis');
	}
}

/* End of file */
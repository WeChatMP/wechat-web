<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Msg extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user = get_login();
		
		if (!$this->user)
		{
			ajax_login();
		}
	}
	
	public function alter()
	{
		ac_check('msg_alter', 2);
		foreach (array('id', 'text') as $key)
		{
			$$key = $this->input->get_post($key);
		}
		if ($id && $text)
		{
			$this->mongo_db->where(array('id' => $id))->update('msgTemplate', array('text' => $text));
			echo json_encode(array('success' => 1));
		}
		else
		{
			echo json_encode(array('success' => 0));
		}
	}
	
	public function index()
	{
		ac_check('msg');
		$msgs = $this->mongo_db->order_by(array('id' => 'ASC'))->get('msgTemplate');
		$this->load->vars('msgs', $msgs);
		$this->load->view('msg');
	}
}

/* End of file */
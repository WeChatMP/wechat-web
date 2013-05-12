<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Baike extends CI_Controller {
	
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
		ac_check('baike', 2);
		foreach (array('word', 'text') as $key)
		{
			$$key = $this->input->get_post($key);
		}
		if ($word && $text)
		{
			$this->mongo_db->where(array('word' => $word))->update('baike', array('text' => $text));
			echo json_encode(array('success' => 1));
		}
		else
		{
			echo json_encode(array('success' => 0));
		}
	}
	
	public function add()
	{
		ac_check('baike', 2);
		foreach (array('word', 'text') as $key)
		{
			$$key = $this->input->get_post($key);
		}
		if ($word && $text)
		{
			$this->mongo_db->insert('baike', array('word' => $word, 'text' => $text));
			echo json_encode(array('success' => 1));
		}
		else
		{
			echo json_encode(array('success' => 0));
		}
	}
	
	public function remove()
	{
		ac_check('baike', 2);
		foreach (array('word') as $key)
		{
			$$key = $this->input->get_post($key);
		}
		if ($word)
		{
			$this->mongo_db->where(array('word' => $word))->delete('baike');
			echo json_encode(array('success' => 1));
		}
		else
		{
			echo json_encode(array('success' => 0));
		}
	}
	
	public function index()
	{
		ac_check('baike');
		$baikes = $this->mongo_db->order_by(array('word' => 'ASC'))->get('baike');
		$this->load->vars('baikes', $baikes);
		$this->load->view('baike');
	}
}

/* End of file */
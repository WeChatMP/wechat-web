<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Plugin extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user = get_login();
		if (!$this->user)
		{
			ajax_login();
		}
	}
	
	public function edit($id, $job = NULL)
	{
		ac_check('plugin', 2);
		if ($job == 'save')
		{
			foreach (array('key', 'name', 'desc', 'header', 'parser', 'handler', 'chain') as $key)
			{
				$param[$key] = $this->input->get_post($key);
			}
			$param['chain'] = (int)$param['chain'];
			$param['param'] = array();
			$this->mongo_db->where(array('key' => $param['key']))->update('commandSchema', $param);
			echo json_encode(array('success' => 1));
			return;
		}
		$plugins = $this->mongo_db->where(array('key' => $id))->get('commandSchema');
		
		if (count($plugins) == 0)
		{
			$this->load->view('error');
			return;
		}
		
		$plugin = $plugins[0];
		
		$this->load->vars('plugin', $plugin);
		$this->load->view('plugin_edit');
	}
	
	public function add($job = NULL)
	{
		ac_check('plugin', 2);
		if ($job == 'save')
		{
			foreach (array('key', 'name', 'desc', 'header', 'parser', 'handler', 'chain') as $key)
			{
				$param[$key] = $this->input->get_post($key);
			}
			$param['chain'] = (int)$param['chain'];
			$param['param'] = array();
			$this->mongo_db->insert('commandSchema', $param);
			echo json_encode(array('success' => 1));
			return;
		}
		$this->load->view('plugin_add');
	}
	
	public function remove($key)
	{
		ac_check('plugin');
		$this->mongo_db->where(array('key' => $key))->delete('commandSchema');
		$this->load->view('plugin_del');
	}
	
	public function index()
	{
		ac_check('plugin');
		$plugins = $this->mongo_db->order_by(array('chain' => 'ASC', 'key' => 'ASC'))->get('commandSchema');
		$this->load->vars('plugins', $plugins);
		$this->load->view('plugin');
	}
}

/* End of file */
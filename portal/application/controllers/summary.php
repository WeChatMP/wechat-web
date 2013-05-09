<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Summary extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user = get_login();
		
		if (!$this->user)
		{
			ajax_login();
		}
	}
	
	public function send_signal()
	{
		ac_check('send_signal', 2);
		$signal = $this->input->get_post('signal');
		$this->load->library('Wechat');
		$reply = $this->wechat->call('signal', array('signal' => $signal));
		if (!$reply)
		{
			echo json_encode(array('success' => 0));
		}
		else
		{
			echo json_encode($reply);
		}
	}
	
	public function send_command()
	{
		ac_check('send_command', 2);
		$command = $this->input->get_post('command');
		$this->load->library('Wechat');
		$reply = $this->wechat->call('command', array('command' => $command));
		if (!$reply)
		{
			echo json_encode(array('success' => 0));
		}
		else
		{
			echo json_encode(array_merge(array('success' => 1), $reply));
		}
	}
	
	public function index()
	{
		ac_check('summary');
		$this->load->library('Wechat');
		$status = $this->wechat->call('status');
		if (!$status)
		{
			$status = array('status' => 'down', 'uptime' => 0, 'request' => 'N/A', 'hit' => 'N/A');
		}
		$this->load->vars('status', $status);
		$this->load->view('summary');
	}
}

/* End of file */
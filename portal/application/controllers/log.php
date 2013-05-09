<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Log extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user = get_login();
		
		if (!$this->user)
		{
			ajax_login();
		}
	}
	
	private function set_where()
	{
		foreach (array('start_time', 'end_time', 'reply', 'key') as $key)
		{
			$$key = $this->input->get_post($key);
		}
		if ($start_time && $end_time)
		{
			$start_time = new MongoDate(strtotime($start_time));
			$end_time = new MongoDate(strtotime($end_time));
			$this->mongo_db->where_between('time', $start_time, $end_time);
		}
		else if ($start_time)
		{
			$this->mongo_db->where_gt('time', $start_time);
		}
		else if ($end_time)
		{
			$this->mongo_db->where_lt('time', $end_time);
		}
		if ($reply)
		{
			$this->mongo_db->where(array('parsed.reply' => $reply));
		}
		if ($key)
		{
			$this->mongo_db->where(array('parsed.key' => $key));
		}
		return $this->mongo_db;
	}
	
	public function query()
	{
		ac_check('log');
		$perpage = 20;
		$total = $this->set_where()->count('commandLog');
		$maxpage = ceil($total / $perpage);
		
		$page = $this->input->get_post('page');
		$page > $maxpage && $page = $maxpage;
		$page < 1 && $page = 1;
		
		$logs = $this->set_where()->order_by(array('time' => 'DESC'))->limit($perpage)->offset(($page - 1) * $perpage)->get('commandLog');
		
		$this->load->vars('total', $total);
		$this->load->vars('maxpage', $maxpage);
		$this->load->vars('page', $page);
		$this->load->vars('perpage', $perpage);
		$this->load->vars('logs', $logs);
		
		$this->load->view('log_query');
	}
	
	public function index()
	{
		ac_check('log');
		$this->load->view('log');
	}
}

/* End of file */
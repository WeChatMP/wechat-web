<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Priv extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->user = get_login();
		$this->acl = array('dashboard' => '进入平台', 'log' => '查询记录', 'msg' => '查看消息模板', 'msg_alter' => '修改消息模板', 'summary' => '查看运行摘要', 'send_signal' => '控制服务', 'send_command' => '测试指令', 'priv' => '查看权限账号', 'priv_edit' => '编辑权限账号', 'priv_del' => '删除权限账号', 'plugin' => '插件管理');
		if (!$this->user)
		{
			ajax_login();
		}
	}
	
	public function edit($username, $job = NULL)
	{
		if ($job == 'save')
		{
			ac_check('priv_edit', 2);
			foreach (array('password', 'acl', 'role') as $key)
			{
				$param[$key] = $this->input->get_post($key);
			}
			if ($param['password'])
			{
				$param['password'] = md5($param['password']);
			}
			else
			{
				unset($param['password']);
			}
			$this->mongo_db->where(array('username' => $username))->update('sysUser', $param);
			echo json_encode(array('success' => 1));
			return;
		}
		ac_check('priv_edit');
		
		$users = $this->mongo_db->where(array('username' => $username))->get('sysUser');
		
		if (count($users) == 0)
		{
			$this->load->view('error');
			return;
		}
		
		$user = $users[0];
		
		$this->load->vars('user', $user);
		$this->load->view('priv_edit');
	}
	
	public function add($job = NULL)
	{
		if ($job == 'save')
		{
			ac_check('priv_edit', 2);
			foreach (array('username', 'password', 'acl', 'role') as $key)
			{
				$param[$key] = $this->input->get_post($key);
			}
			$param['password'] = md5($param['password']);
			$this->mongo_db->insert('sysUser', $param);
			echo json_encode(array('success' => 1));
			return;
		}
		ac_check('priv_edit');
		$this->load->view('priv_add');
	}
	
	public function revoke($username)
	{
		ac_check('priv_del');
		$this->mongo_db->where(array('username' => $username))->delete('sysUser');
		$this->load->view('priv_del');
	}
	
	public function index()
	{
		ac_check('priv');
		$users = $this->mongo_db->order_by(array('username' => 'ASC'))->get('sysUser');
		$this->load->vars('users', $users);
		$this->load->view('priv');
	}
}

/* End of file */
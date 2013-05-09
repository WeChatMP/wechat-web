<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Session {

	/**
	 * ������
	 */
	public function __construct()
	{
		session_start();
	}

	// --------------------------------------------------------------------

	/**
	 * д��Ự����
	 *
	 * ��Ựд��һ����Ϣ
	 *
	 * @param	string	$name
	 * @param	mixed	$value
	 * @return	void
	 */
	public function set($name, $value = NULL)
	{
		if (!isset($value) || $value == '')
		{
			$this->delete($name);
		}else{
			$_SESSION[$name] = $value;
		}
	}
	
	/**
	 * ��ȡ�Ự����
	 *
	 * ��ȡ�Ự��ָ�����Ƶ�����
	 *
	 * @param	string	$name
	 * @return	mixed
	 */
	public function get($name)
	{
		if (!isset($_SESSION[$name]))
		{
			return NULL;
		}else{
			return $_SESSION[$name];
		}
	}
	
	/**
	 * ɾ���Ự����
	 *
	 * ɾ��ָ�����ƵĻỰ����
	 *
	 * @param	string	$name
	 * @return	void
	 */
	public function delete($name)
	{
		unset($_SESSION[$name]);
	}
	
	/**
	 * ɾ���Ự
	 *
	 * �������еĻỰ���ݣ��ͻ����´η���ҳ��ʱ����һ���µ�SESSION
	 *
	 * @return	void
	 */
	public function dispose()
	{
		session_destroy();
	}

}

/* End of file */
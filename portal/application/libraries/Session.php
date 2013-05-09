<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Session {

	/**
	 * 构造器
	 */
	public function __construct()
	{
		session_start();
	}

	// --------------------------------------------------------------------

	/**
	 * 写入会话数据
	 *
	 * 向会话写入一条信息
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
	 * 获取会话数据
	 *
	 * 获取会话中指定名称的数据
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
	 * 删除会话数据
	 *
	 * 删除指定名称的会话数据
	 *
	 * @param	string	$name
	 * @return	void
	 */
	public function delete($name)
	{
		unset($_SESSION[$name]);
	}
	
	/**
	 * 删除会话
	 *
	 * 销毁所有的会话数据，客户端下次访问页面时将是一个新的SESSION
	 *
	 * @return	void
	 */
	public function dispose()
	{
		session_destroy();
	}

}

/* End of file */
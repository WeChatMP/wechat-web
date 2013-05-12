<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CI_Wechat {

	public function __construct()
	{
	}

	public function call($method, $param = NULL)
	{
		$CI =& get_instance();
		
		$context = array();

		$context['http'] = array(
			'method' => 'POST',
			'header' => 'Content-Type: application/json\r\n',
			'content' => '[]'
		);
		
		if ($param)
		{
			$context['http'] = array(
				'method' => 'POST',
				'header' => 'Content-Type: application/json\r\n',
				'content' => json_encode($param)
			);
		}

		return json_decode(file_get_contents($CI->config->item('wechat_service') . 'api/' . $method, false, stream_context_create($context)), TRUE);
	}
	
}

/* End of file */
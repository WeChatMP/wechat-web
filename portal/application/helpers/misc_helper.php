<?php
function query_from_param($table, $params, $single = FALSE)
{
	$CI =& get_instance();
	$where = array();
	foreach ($params as $key)
	{
		$where[$key] = $CI->input->get_post($key);
		if ($key == 'password')
		{
			$where[$key] = md5($where[$key]);
		}
	}
	if ($single)
	{
		$query = $CI->mongo_db->where($where)->get($table);
		if (count($query) == 0)
		{
			return FALSE;
		}
		return $query[0];
	}
	else
	{
		return $CI->mongo_db->where($where)->get($table);
	}
}

function get_login()
{
	$CI =& get_instance();
	$CI->load->library('Session');
	$user = $CI->session->get('user');
	if (!$user) return FALSE;
	return $user;
}

function set_login($user)
{
	$CI =& get_instance();
	$CI->load->library('Session');
	$CI->session->set('user', $user);
}

function clear_login()
{
	$CI =& get_instance();
	$CI->load->library('Session');
	$CI->session->delete('user');
}

function timespan($tick)
{
	$parse['day'] = floor($tick / 86400);
	$parse['hour'] = floor($tick % 86400 / 3600);
	$parse['minute'] = floor($tick % 3600 / 60);
	$parse['second'] = $tick % 60;
	return $parse;
}

function ajax_login()
{
	echo '<script type="text/javascript">logout();</script>';
	die;
}

function ac_check($action, $take_action = 1)
{
	$user = get_login();
	if ($take_action)
	{
		if (!in_array($action, $user['acl']))
		{
			if ($take_action == 1)
			{
				$CI =& get_instance();
				echo $CI->load->view('denied', NULL, TRUE);
			}
			else
			{
				echo json_encode(array('success' => 0));
			}
			die;
		}
	}
	else
	{
		return in_array($action, $user['acl']);
	}
}

function cut_str($string, $sublen, $start = 0) 
{ 
	$pa = "/[\x01-\x7f]|[\xc2-\xdf][\x80-\xbf]|\xe0[\xa0-\xbf][\x80-\xbf]|[\xe1-\xef][\x80-\xbf][\x80-\xbf]|\xf0[\x90-\xbf][\x80-\xbf][\x80-\xbf]|[\xf1-\xf7][\x80-\xbf][\x80-\xbf][\x80-\xbf]/"; 
	preg_match_all($pa, $string, $t_string); 
 
	if(count($t_string[0]) - $start > $sublen) return join('', array_slice($t_string[0], $start, $sublen))."..."; 
	return join('', array_slice($t_string[0], $start, $sublen)); 
}

function microtime_diff( $start, $end=NULL ) { 
	if( !$end ) 
	{ 
		$end = microtime(); 
	} 
	list($start_usec, $start_sec) = explode(" ", $start); 
	list($end_usec, $end_sec) = explode(" ", $end); 
	$diff_sec = intval($end_sec) - intval($start_sec); 
	$diff_usec = floatval($end_usec) - floatval($start_usec); 
	return floatval( $diff_sec ) + $diff_usec; 
}
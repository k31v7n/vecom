<?php 
if(!function_exists('login')){
	function login(){

		if (isset($_SESSION['UserID']) && empty($_SESSION['UserID'])) {
			return true;
		
		}
		return false;
	}
}

if (!function_exists('script_tag')) {
	function script_tag($src, $print=false) 
	{
		if ($print) {
			$link = "<script type='text/javascript'>\n" . file_get_contents(base_url($src)) . "\n</script>\n";
		} else {
			$CI =& get_instance();
			$link = '<script type="text/javascript" ';
			if (preg_match('#^([a-z]+:)?//#i', $src)) {
				$link .= 'src="'.$src.'" ';
			}
			else {
				$link .= 'src="'.$CI->config->slash_item('base_url').$src.'" ';
			}
			
			$link .= "></script>\n";
		}
		return $link;
	}
}

if (!function_exists('elemento')) {
	function elemento($args, $indice, $valor=false) 
	{
		if (is_array($args) && array_key_exists($indice, $args) && 
			!empty($args[$indice]) && $args[$indice]) {
			
			return $args[$indice];
		}

		return $valor;
	}
}

if (!function_exists('enviarJson')) {
	function enviarJson($datos) 
	{
		header('Content-type: application/json');
		echo json_encode($datos);
	}
}

if (!function_exists('arrayResult')) {
	function arrayResult($datos, $campo)
	{
		$result = array();
		
		foreach ($datos as $key => $row) {
			$result[] = $row->$campo;
		}

		return $result;
	}	
}
?>
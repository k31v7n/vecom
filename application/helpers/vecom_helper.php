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

if (!function_exists('style_tag')) {
	function style_tag($href, $print=false) 
	{
		if ($print) {
			$link = "<style type='text/css'>\n" . file_get_contents(base_url($href)) . "\n</style>\n";
		} else {
			$CI =& get_instance();
			$link = '<link rel="stylesheet" type="text/css" ';
			if (preg_match('#^([a-z]+:)?//#i', $href)) {
				$link .= 'href="'.$href.'" ';
			}
			else {
				$link .= 'href="'.$CI->config->slash_item('base_url').$href.'" ';
			}
			
			$link .= "/>\n";
		}
		return $link;
	}
}

if (!function_exists('elemento')) {
	function elemento($args, $indice, $valor=false) 
	{
		if (is_object($args)) {
			$args = (array)$args;
		}
		
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

if (!function_exists('diasPassword')) {
	function diasPassword()
	{
		return 60;
	}
}

if (!function_exists('FormatoFecha')) {
	function FormatoFecha($fecha, $tipo)
	{
		switch ($tipo) {
			case 1:
				return date("d/m/Y H:i", strtotime($fecha));
				break;
			case 2:
				return date("d-m-Y", strtotime($fecha));
				break;
			case 3:
				return date("d-m-Y H:i", strtotime($fecha));
				break;
			default:
				return date("d-m-Y", strtotime($fecha));
				break;
		}
	}
}

if (!function_exists('nota_actualizacion')) {
	function nota_actualizacion($dias) 
	{
		if ($dias == 0) {
			$dato = 'hoy';
		} else if ($dias == 1) {
			$dato = 'hace 1 día';
		} else if ($dias <= 7) {
			$dato = "hace {$dias} días";

		} else if ($dias > 7) {
			$semanas = round($dias / 7);
			if ($semanas >= 4) {
				$meses = round($semanas / 4);
				$dato = "hace {$meses} meses";
			} else {
				$dato = "hace {$semanas} semanas";
			}

		} else {
			$dato = "Actualización pendiente";
		}

		return $dato;
	}
}

if (!function_exists('comboOpciones')) {
	function comboOpciones($datos, $campo1, $campo2)
	{	
		$result = ['' => '---------------'];

		if ($datos) {
			foreach ($datos as $key => $row) {
				$result[$row->$campo1] = $row->$campo2;
			}
		}

		return $result;
	}
}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clasificacion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('proveedor/Clasificacion_model');
	}

	public function form($clasificacion='')
	{
		$this->load->library('forms/proveedor/Fclasificacion');
		$cla 	= null;
		$m 		= new Clasificacion_model();
		$form   = new Fclasificacion();
		$form->set_accion(base_url("index.php/proveedor/clasificacion/guardar/{$clasificacion}"));
		if (!empty($clasificacion)) {
			$m->set_registro($clasificacion);
			$form->set_registro($m->get_registro());
			$cla = $m->get_registro();
		}

		$this->load->view('proveedor/clasificacion/form', [
			"form" 			=> $form->get_formulario(),
			"clasificacion" => $cla
		]);

	}

	public function guardar($clasificacion='')
	{
		$exito 		= $res = false;
		$mensaje 	= "Error";
		$m 			= new Clasificacion_model();

		$res = $m->guardar($_POST);

		if ($res) {
			$exito=true;
		}

		$mensaje = $m->get_mensaje();

		enviarJson([
			"exito"   		=> $exito,
			"mensaje" 		=> $mensaje,
			"clasificacion" => $res
		]);
	}

	public function lista_opciones($clasificacion='')
	{
		$m = new Clasificacion_model();

		$this->load->view('proveedor/clasificacion/lista_opciones', [
			"registros" 	=> $m->get_clasificaciones(),
			"clasificacion" => $clasificacion
		]);
	}
}
?>
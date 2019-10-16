<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('proveedor/Tipo_model');
	}
	
	public function form($tipo='')
	{
		$this->load->library('forms/proveedor/Ftipo');
		$m    = new Tipo_model();
		$form = new Ftipo();
		$form->set_accion(base_url("index.php/proveedor/tipo/guardar/{$tipo}"));

		if (!empty($tipo)) {
			$m->set_tipo($tipo);
			$form->set_registro($m->get_tipo());
		}

		$this->load->view('proveedor/tipo/form', [
			"form" 		=> $form->get_formulario(),
		]);


	}

	public function guardar($tipo='')
	{
		$mensaje = "Error";
		$exito   = false;
		$m 		 = new Tipo_model();

		if (!empty($tipo)) {
			$m->set_tipo($tipo);
		}

		$res = $m->guardar($_POST);

		if ($res) {
			$exito = true;
		}

		$mensaje = $m->get_mensaje();

		enviarJson([
			"exito" 			=> $exito,
			"mensaje" 			=> $mensaje,
			"tipo_proveedor" 	=> $res
		]);
	}

	public function lista_opciones($tipo="")
	{
		$m = new Tipo_model();
		$this->load->view('proveedor/tipo/lista_opciones', [
			"registros" 	=> $m->get_tipos(),
			"tipo"      	=> $tipo
		]);
	}

}
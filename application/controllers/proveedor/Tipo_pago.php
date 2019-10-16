<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tipo_pago extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model('proveedor/Tipo_pago_model');
	}
	
	public function form($tipo_pago='')
	{
		$this->load->library('forms/proveedor/Ftipo_pago');
		$m    = new Tipo_pago_model();
		$form = new Ftipo_pago();
		$form->set_accion(base_url("index.php/proveedor/tipo_pago/guardar/{$tipo_pago}"));

		if (!empty($tipo_pago)) {
			$m->set_tipo_pago($tipo_pago);
			$form->set_registro($m->get_tipo_pago());
		}

		$this->load->view('proveedor/tipo_pago/form', [
			"form" 		=> $form->get_formulario(),
		]);


	}

	public function guardar($tipo_pago='')
	{
		$mensaje = "Error";
		$exito   = false;
		$m 		 = new Tipo_pago_model();

		if (!empty($tipo_pago)) {
			$m->set_tipo_pago($tipo_pago);
		}

		$res = $m->guardar($_POST);

		if ($res) {
			$exito = true;
		}

		$mensaje = $m->get_mensaje();

		enviarJson([
			"exito" 			=> $exito,
			"mensaje" 			=> $mensaje,
			"tipo_pago_proveedor" 	=> $res
		]);
	}

	public function lista_opciones($tipo_pago="")
	{
		$m = new Tipo_pago_model();
		$this->load->view('proveedor/tipo_pago/lista_opciones', [
			"registros" 	=> $m->get_tipos_pago(),
			"tipo_pago"      	=> $tipo
		]);
	}

}
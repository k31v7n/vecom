<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Compra extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'compra/Compra_model',
			'proveedor/Proveedor_model',

		]);
		$this->scripts = array(
			(object)array("ruta" => "public/js/compra.js", "imp" => true)
		);
	}

	public function index()
	{
		$this->load->view('principal', [
			"vista" 	=> "compra/compra/cuerpo",
			"scripts" 	=> $this->scripts
		]);
	}

	public function form($compra='')
	{
		$this->load->library('forms/compra/Fcompra');
		$reg 	= null;
		$m 		= new Compra_model();
		$form 	= new Fcompra();
		$pm 	= new Proveedor_model();

		$form->set_accion(base_url("index.php/compra/compra/guardar/{$compra}"));
		$form->set_proveedores($pm->get_proveedores());
		$form->set_tipos_pago($m->get_tipo_pago());
		$form->set_monedas($this->vecom->verMonedas());

		if (!empty($compra)) {
			$m->set_compra($compra);
			$reg = $m->get_compra();
			$form->set_registro($reg);
		}

		$this->load->view('compra/compra/form',[
			"form" 	 => $form->get_formulario(),
			"compra" => $reg
		]);
	}

	public function guardar($compra='')
	{
		$mensaje 	= "Error";
		$exito 		= false;
		$m = new Compra_model();

		if (!empty($compra)) {
			$m->set_compra($compra);
		}else{
			$_POST["compra_estatus"] = "1";
		}

		$res = $m->guardar($_POST);

		if ($res) {
			$exito = true;
		}

		$mensaje = $m->get_mensaje();

		enviarJson([
			"exito" 	=> $exito,
			"mensaje" 	=> $mensaje,
			"compra"  	=> $res
		]);
	}

	public function buscar()
	{
		$m 	 = new Compra_model();

		$datos = $m->buscar();

		$this->load->view('compra/compra/lista', [
			"registros" => $datos
		]);
	}

	public function actualizar_estatus($compra='', $estatus='')
	{
		$mensaje = "Ocurrió un error el actualizar el estatus de la compra";
		$exito   = false;

		if (!empty($compra)) {
			$m = new Compra_model();
			$m->set_compra($compra);

			$res = $m->guardar([
				"compra_estatus" => $estatus
			]);

			if ($res) {
				$exito 	 = true;
				$mensaje = "Se actualió correctamente el estatus de la compra";
			}


		}

		enviarJson([
			"exito"   => $exito,
			"mensaje" => $mensaje,
			"compra"  => $compra
		]);
	}
}
?>
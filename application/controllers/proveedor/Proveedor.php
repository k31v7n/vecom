<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proveedor extends CI_Controller {
	
	public function __construct()
	{ 
		parent::__construct();
		$this->load->model('proveedor/Proveedor_model');
		$this->load->model('proveedor/Clasificacion_model');
		$this->load->model('proveedor/Tipo_model');
		$this->scripts = array(
			(object)array("ruta" => "public/js/proveedor.js", "imp" => true)
		);
	}

	public function index()
	{
		$m    = new Proveedor_model();
		$this->load->view('principal', [
			"vista" 	=> "proveedor/proveedor/cuerpo",
			"scripts" 	=> $this->scripts,
			"registros" => $m->get_proveedores()
		]);
	}


	public function form($modal=false, $proveedor="")
	{
		$this->load->library('forms/proveedor/Fproveedor');

		$pro  = null;
		$m    = new Proveedor_model();
		$ptm  = new Tipo_model();
		$form = new Fproveedor($modal);
		$cm   = new Clasificacion_model();

		$form->set_accion(base_url("index.php/proveedor/proveedor/guardar/{$proveedor}"));
		$form->set_proveedor_tipo($ptm->get_tipos());

		$form->set_clasificaciones($cm->get_clasificaciones());

		$form->set_tipo_pago($m->get_tipo_pago());

		if (!empty($proveedor)) {
			$m->set_proveedor($proveedor);
			$form->set_registro($m->get_proveedor());
			$pro = $m->get_proveedor();
		}

		$this->load->view('proveedor/proveedor/form',[
			"form"  => $form->get_formulario(),
			"modal" => $modal
		]);	
	}

	public function guardar($proveedor='')
	{
		$m       = new Proveedor_model();
		$mensaje = "¡Error!";
		$exito   = false;

		if (!empty($proveedor)) {
			$m->set_proveedor($proveedor);
		}

		$res = $m->guardar_proveedor($_POST);
		if ($res) {
			$exito = true;
		}

		$mensaje = $m->get_mensaje();

		enviarJson([
			"exito"   	=> $exito,
			"mensaje" 	=> $mensaje,
			"proveedor" => $res
		]);
	}

	public function filtrar()
	{
		$m = new Proveedor_model();
		$this->load->view('proveedor/proveedor/lista', [
			"registros" => $m->get_proveedores()
		]);
	}

	public function lista_opciones($proveedor='')
	{
		$m = new Proveedor_model();
		
		$this->load->view('proveedor/proveedor/lista_opciones', [
			"registros" => $m->get_proveedores(),
			"proveedor" => $proveedor
		]);
	}

	public function dar_de_baja($proveedor='')
	{
		$mensaje = "¡Error!";
		$exito   = false;

		if (!empty($proveedor)) {

			$m = new Proveedor_model();
			$m->set_proveedor($proveedor);

			$res = $m->guardar_proveedor([
				"activo" => "0"
			]);

			if ($res) {
				$exito   = true;
				$mensaje = "Se dió de baja correctamente al proveedor.";
			}else{
				$mensaje = "Ocurrió un error al dar de baja al proveedor.";
			}


		}else{
			$mensaje = "No se indico el proveedor a anular";
		}

		enviarJson([
			"exito"   => $exito,
			"mensaje" => $mensaje,
			"de_baja" => true
		]);
	}
}
?>
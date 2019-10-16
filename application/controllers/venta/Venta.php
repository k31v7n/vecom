<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Venta extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'venta/Venta_model', 
			'venta/Detalle_model', 
			'producto/Producto_model'
		]);
		$this->scripts = array((object) array('ruta' => 'public/js/venta.js', 'imp' => true));
		#estado anulado
		$this->estatus_anulado = 3;
	}

	public function index()
	{
		$mensaje = false;
		if (elemento($_SESSION, "mensaje")) {
			$mensaje = $_SESSION["mensaje"];
			unset($_SESSION["mensaje"]);
		}

		$this->load->view('principal', [
			'vista'   		=> 'venta/venta/cuerpo',
			'f_producto' 	=> 'venta/detalle/filtro_productos',
			'scripts' 		=> $this->scripts,
			'mensaje' 		=> $mensaje,
			'registros' 	=> $this->Venta_model->get_ventas([
				"lista_menu" => true
			])
		]);
	}

	public function form($venta='')
	{
		$this->load->library('forms/venta/Fventa');
		$m 	  = new Venta_model();
		$form = new Fventa();
		$form->set_accion(base_url("index.php/venta/venta/guardar/{$venta}"));

		if (!empty($venta)) {
			$m->set_venta($venta);
			$form->set_registro($m->get_venta());
		}else{
			#Estado activa en tabla venta_estatus
			$form->set_venta_activa(3); 
		}

		$clientes = $this->vecom->verClientes();
		$form->set_clientes($clientes);

		$form->set_estatus($m->get_venta_estatus());
		$form->set_tipo_pago($m->get_tipo_pago());

		$monedas = $this->vecom->verMonedas();
		$form->set_monedas($monedas);

		$this->load->view('venta/venta/form',[
			'form'    => $form->get_formulario(),
			'venta'	  => $m->get_venta()
		]);
	}

	public function guardar($venta='')
	{
		$res['mensaje']  = "Error";// $vm->get_mensaje
		$res['exito'] 	 = false;
		$res['venta']    = false;

		$vm = new Venta_model();
		if (!empty($venta)) {
			$vm->set_venta($venta);
		}

		$vta = $vm->guardar($_POST);
		if ($vta) {
			$res['exito'] = true;
			$res['venta'] = $vta;
		}

		$res['mensaje'] = $vm->get_mensaje();

		enviarJson($res);
	}

	public function lista_menu()
	{
		$m = new Venta_model();

		$this->load->view('venta/venta/lista_menu', [
			"registros" => $m->get_ventas_menu()
		]);
	}

	public function encabezado($venta='')
	{
		$m = new Venta_model();
		if (!empty($venta)) {
			$m->set_venta($venta);
		}

		$this->load->view('venta/venta/encabezado', [
			"venta" => $m->get_venta()
		]);
		$m->get_venta();
	}

	public function anular($venta='')
	{
		$res["exito"] 	= false;
		$res["mensaje"] = "¡Error al anular!";
		$res["venta"]   = $venta;

		if (!empty($venta)) {

			$m = new Venta_model();
			$m->set_venta($venta);

			$resp = $m->guardar([
				"venta_estatus" => $this->estatus_anulado
			]);

			if ($resp) {
				$res["mensaje"] = "Se anuló correctamente la venta #{$venta}";
				$res["exito"] 	= true;

			}else{
				$res["mensaje"] = "Se anuló correctamente la venta #{$venta}";

			}
		}else{
			$res["mensaje"] = "Debe indicar la venta a anular";

		}

		if ($res["exito"]) {
			$_SESSION["mensaje"] = $res["mensaje"];
			$this->actualizar_productos($venta);
		}

		enviarJson($res);
	}

	private function actualizar_productos($venta='')
	{
		$productos = $this->Detalle_model->get_detalles($venta);
		$m = new Producto_model();
		foreach ($productos as $row) {
			$m->set_producto($row->producto);
			$m->actualizar_cantidad();
		}
	}
}
?>
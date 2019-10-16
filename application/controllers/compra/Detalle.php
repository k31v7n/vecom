<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalle extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'compra/Detalle_model',
			'compra/Compra_model',
			'producto/Producto_model'
		]);
	}
	
	public function form($compra="", $detalle='')
	{
		$this->load->library('forms/compra/Fdetalle');
		$m 		= new Detalle_model();
		$form 	= new Fdetalle($detalle);
		$pm 	= new Producto_model();

		$form->set_accion(base_url("index.php/compra/detalle/guardar/{$compra}/{$detalle}"));
		$form->set_productos($pm->get_productos());

		if (!empty($detalle)) {
			$m->set_detalle($detalle);
			$form->set_registro($m->get_detalle());
		}

		$this->load->view('compra/detalle/form', [
			"form" => $form->get_formulario()
		]);
	}

	public function detalles_compra($compra='')
	{
		$this->load->view('compra/detalle/lista', [
			"registros" => $this->Detalle_model->get_detalles_compra($compra)
		]);
	}

	public function tr_nuevo($compra='')
	{
		$m = new Compra_model();

		if (!empty($compra)) {
			$m->set_compra($compra);
		}

		$this->load->view('compra/detalle/tr_nuevo', [
			"compra" => $m->get_compra()
		]);
	}

	public function guardar($compra="", $detalle="")
	{
		$mensaje = "";
		$res 	 = false;

		if (!empty($compra)) {
			$m 	= new Detalle_model();
			$c 	= new Compra_model();
			$p  = new Producto_model();
			$c->set_compra($compra);

			if (!empty($detalle)) {
				$m->set_detalle($detalle);
			}else{
				$_POST["compra"] = $compra;
			}

			$res = $m->guardar($_POST);
			if ($res) {
				$exito = true;
			}
			$mensaje .= $m->get_mensaje();

			if ($exito) {
				
				$res_com = $c->actualizar_total();
				if ($res_com) {
					$exito = true;
				}
				$mensaje .= $c->get_mensaje();

				if ($exito) {

					$p->set_producto($_POST['producto']);
					$res_pro = $p->actualizar_cantidad();
					if ($res_pro) {
						$exito = true;
					}
					$mensaje .= $p->get_mensaje();

				}else{
					$mensaje .= " No se actualizo la cantidad de productos.";
				}


			}else{
					$mensaje .= "No se actualizo el total de la compra";
			}
			
		}else{
			$mensaje .= "No se tiene una compra para asociar el detalle";
		}
		enviarJson([
			"exito" 	=> $exito,
			"mensaje" 	=> $mensaje,
			"detalle_compra" => $res,
			"compra" => $compra
		]);
	}

}
?>
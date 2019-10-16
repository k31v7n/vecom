	<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Detalle extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('venta/Venta_model');
		$this->load->model('producto/Producto_model');
		$this->load->model('venta/Detalle_model');
		$this->load->model('mante/Empresa_model');
		$this->scripts = array((object) array('ruta' => 'public/js/venta.js', 'imp' => true));
	}

	public function form($venta='', $detalle='')
	{
		$this->load->library('forms/venta/Fdetalle');
		$vm   = new Venta_model();
		$m 	  = new Detalle_model();
		$form = new Fdetalle();
		$pm   = new Producto_model();

		$vm->set_venta($venta);
		$form->set_accion(base_url("index.php/venta/detalle/guardar/{$venta}/{$detalle}"));
		$form->set_productos($pm->get_productos());
		if (!empty($detalle)) {
			$m->set_detalle($detalle);
			$form->set_registro($m->get_detalle());
		}

		$this->load->view('venta/detalle/form', [
			"form" 		=> $form->get_formulario(),
			"venta"		=> $vm->get_venta(),
			"detalle"	=> $m->get_detalle()
		]);
	}

	public function guardar($venta='', $detalle='', $anular=false)
	{
		$res["mensaje"]   = "Error!";
		$res["exito"]     = false;
		$res["detalle"]   = true;
		$res["venta"]     = $venta;

		if (empty($venta)) {
			$res["mensaje"] = "Debe crear una venta para continuar.";
		}else{
			$m  	 = new Detalle_model();
			$pm 	 = new Producto_model();
			$vm 	 = new Venta_model();

			if(elemento($_SESSION, 'EmpresaID')){

				$emp 	 = $this->Empresa_model->verEmpresa($_SESSION['EmpresaID']);
				if ($emp) {
					$m->set_moneda_empresa($emp->moneda);
				}

			}
			if (elemento($_POST, "producto")) {
				$pm->set_producto($_POST["producto"]);
			}else{
				$m->set_detalle($detalle);
				$d = $m->get_detalle();
				$pm->set_producto($d->producto);
			}

			$prod = $pm->get_producto();
			$cantidad = ((elemento($_POST, "cantidad"))? $_POST["cantidad"]: '1');
			$precio   = (elemento($_POST, "precio"))? $_POST["precio"]: $prod->precio_venta;
			if (empty($detalle)) {

				//Comprueba si existe un detalle de la venta con el mismo producto al mismo precio
				$tmp = $m->comprobar_producto([
					"venta" 	=> $venta,
					"producto"  => $_POST["producto"],
					"precio" 	=> $precio
				]);
				
				$ars = [//Dato iniciales en asi de que no exista un detalle
					"cantidad" =>  $cantidad,
					"precio"   => $precio,
					"total"    => $cantidad * $precio,
					"anulado"  => "0",
					"venta"    => $venta,
					"producto" => $prod->producto
				];

				if ($tmp) { //Si existe un producto al mismo precio en la venta
					$m->set_detalle($tmp->venta_detalle);
					$detalle = $m->get_detalle();
					$ars["cantidad"] = $cantidad + $detalle->cantidad;
					$ars["total"]    = $ars["cantidad"] * $detalle->precio;
				}

				$tmp = $m->guardar_detalle($ars);
				if ($tmp) {
					$res["exito"] = true;
				}

				$res["mensaje"] = $m->get_mensaje();

			}elseif(!empty($detalle) && !$anular){
				$m->set_detalle($detalle);
				$det = $m->get_detalle();
				if (($prod->cantidad + $det->cantidad) < $_POST["cantidad"]) {
					$res["mensaje"] = "No se puede aumentar la cantidad del producto, solo tienen {$prod->cantidad} en existencia.";

				}else{
					$ars = [//Dato iniciales en caso de que no exista un detalle
						"cantidad" => $_POST["cantidad"],
						"precio"   => $precio,
						"total"    => $cantidad * $precio,
					];

					$tmp = $m->guardar_detalle($ars);
					if ($tmp) {
						$res["exito"] = true;
					}

					$res["mensaje"] = $m->get_mensaje();
				}
				
			}elseif(!empty($detalle) && $anular) {

				$resp = $m->guardar_detalle([
					"anulado" => '1'
				]);

				if ($resp) {
					$res["mensaje"] = "Se anuló correctamente el detalle de la venta.";
					$res["exito"]   = true;
				}else{
					$res["mensaje"] = "No se pudo anular el detalle de la venta.";
				}
			}
		}

			if ($res["exito"]) {//Si la respuesta es exitosa se alcula la existencia del producto
				$pm->actualizar_cantidad();
				$vm->set_venta($venta);
				$vm->actualizar_valores();
			}

		enviarJson($res);
	}

	public function lista($venta='')
	{
		$vm= new Venta_model();
		$vm->set_venta($venta);

		$m = new Detalle_model();
		
		$this->load->view('venta/detalle/lista', [
			"registros" => $m->get_detalles($venta),
			"venta"		=> $vm->get_venta()
		]);
	}


	public function lista_productos($venta='')
	{
		$pm  = new Producto_model();
		$this->load->view('venta/detalle/lista_productos', [
			"productos" => $pm->get_productos(array_merge($_POST, ["existentes" => true])),
			"venta"     => $venta
		]); 
	}

	public function actualizar_cantidades()
	{
		$productos = $this->db->get("producto")->result();

		$m = new Producto_model();
		foreach ($productos as $producto) {
			$m->set_producto($producto->producto);
			if ($m->actualizar_cantidad()) {
				echo "<pre>";
				print_r ("Se actualizo la cantidad del produto {$producto->producto}");
				echo "</pre>";
			}else{
				echo "<pre>";
				print_r ("No se actualizo la cantidad del produto {$producto->producto}");
				echo "</pre>";
			}
		}
	}

}
?>
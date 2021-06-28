<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Producto extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model([
			'producto/Producto_model',
			'proveedor/Proveedor_model'
		]);
		$this->scripts = array(
			(object)array("ruta" => "public/js/producto.js", "imp" => true)
		);
	}

	public function index()
	{
		$m = new Producto_model();
		$this->load->view('principal', [
			"vista" 	=> "producto/producto/cuerpo",
			"scripts"	=> $this->scripts
		]);
	}

	public function form($producto='')
	{
		$this->load->library('forms/producto/Fproducto');
		$form 	= new Fproducto();
		$m 		= new Producto_model();
		$pm 	= new Proveedor_model();

		if (!empty($producto)) {
			$m->set_producto($producto);
			$form->set_registro($m->get_producto());
		}

		$form->set_accion(base_url("index.php/producto/producto/guardar/{$producto}"));
		$form->set_proveedor($pm->get_proveedores());

		$form->set_unidad_medida($m->get_unidad_medida());
		$form->set_produco_tipo($m->get_producto_tipo());

		$this->load->view('producto/producto/form', [
			"producto"  => $m->get_producto(),
			"form" 		=> $form->get_formulario()
		]);
	}

	public function guardar($producto='')
	{
		$mensaje = "Error";
		$exito 	 = false;
		$m = new Producto_model();

		if (!empty($producto)) {
			$m->set_producto($producto);
		}

		if (isset($_FILES['imagen'])) {

			$nombre = $_FILES['imagen']['name'];

			$ruta = "public/productos/{$nombre}";

	
			if (move_uploaded_file($_FILES['imagen']['tmp_name'], FCPATH.'/'.$ruta)) {
				$_POST['imagen'] = $ruta;
			}
		}

		$res = $m->guardar_producto($_POST);
		if ($res) {
			$exito = true;
		}

		$mensaje = $m->get_mensaje();

		enviarJson([
			"mensaje"  => $mensaje,
			"exito"	   => $exito,
			"producto" => $res
		]);
	}

	public function filtar()
	{
		$m = new Producto_model();
		$this->load->view('producto/producto/lista', [
			"registros" => $m->get_productos()
		]);
	}

	public function get_producto($producto='')
	{
		$reg = false;
		if (!empty($producto)) {
			$m = new Producto_model();
			$m->set_producto($producto);
			$reg = $m->get_producto();
		}

		enviarJson($reg);
	}


	public function anular($producto='')
	{
		$exito 	 = false;
		$mensaje = "¡Error!";

		if (!empty($producto)) {
			$m = new Producto_model();
			$m->set_producto($producto);

			$res = $m->guardar_producto([
				"activo" => '0'
			]);

			if ($res) {
				$exito   = true;
				$mensaje = "Se anuló correctamente el producto.";

			}else{
				$mensaje = "Ocurrió un error al anular el producto.";
			}

		}else{
			$mensaje = "No se ha indicado el producto que se desea anular.";
		}

		enviarJson([
			"exito" 	=> $exito,
			"mensaje" 	=> $mensaje
		]);
	}

}
?>
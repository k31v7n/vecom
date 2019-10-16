<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cliente_model");
	}

	public function form($cliente='')
	{
		$this->load->library('forms/cliente/Fcliente');
		$m 	  = new Cliente_model();
		$form = new Fcliente();

		if (!empty($cliente)) {
			$m->set_cliente($cliente);
			$form->set_registro($m->get_cliente());
		}

		$form->set_accion(base_url("index.php/cliente/guardar/{$cliente}"));
		$this->load->view('cliente/form', [
			"form" => $form->get_formulario()
		]);
		
	}

	public function guardar($cliente='')
	{
		$exito 	 = false;
		$mensaje = "Error";
		$cliente = false;

		$m 		 = new Cliente_model();
		if (!empty($cliente)) {
			$m->set_cliente($cliente);
		}

		$res = $m->guardar($_POST);
		if ($res) {
			$exito = true;
			$cliente = $res;
		}
		$mensaje = $m->get_mensaje();
		enviarJson([
			"exito" 	=> $exito,
			"mensaje" 	=> $mensaje,
			"cliente"	=> $cliente
		]);
	}

	public function lista_opciones($id='')
	{
		$this->load->view('cliente/lista_opciones',[
			'registros' => $this->vecom->verClientes(),
			'id'		=> $id
		]);
	}

}

/* End of file Cliente.php */
/* Location: ./application/controllers/Cliente.php */
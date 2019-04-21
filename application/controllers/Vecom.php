<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vecom extends CI_Controller {

	public function index()
	{
		die('Acceso denegado por '.$_SESSION['EmpresaName']);
	}

	public function buscar_menu()
	{
		$this->load->view('menu/buscar', [
			'opciones' => $this->Menu_model->buscar_menu($_POST)
		]);
	}

}

/* End of file Vecom.php */
/* Location: ./application/controllers/Vecom.php */
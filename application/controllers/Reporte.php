<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reporte extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('venta/Venta_model');
	}

	public function index()
	{
		$this->load->view('principal', [
			'header' => true,
			'menu'   => 'menu',
			'vista'  => 'reporte/cuerpo',
			'estatus' => $this->vecom->verEstatus()
		]);
	}

	public function buscar()
	{
		$this->load->view('reporte/lista', [
			'lista' => $this->Venta_model->get_ventas($_POST)
		]);
	}
}

/* End of file Reporte.php */
/* Location: ./application/controllers/Reporte.php */
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tablero extends CI_Controller {

	public function index()
	{
		$this->load->view('principal', [
			'header' => true,
			'menu'   => 'menu',
			'vista'  => 'tablero/cuerpo'
		]);
	}

	public function test()
	{
		
	}

}

/* End of file Principal.php */
/* Location: ./application/controllers/Principal.php */
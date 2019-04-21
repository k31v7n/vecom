<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inicio
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
     	$this->autorizadas = [
     		"/vips/vecom/",
     		"/sesion/iniciar"
     	];   
	}

	public function verificar()
	{
		$segmento = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : $_SERVER['REQUEST_URI'];
		
		if (!isset($_SESSION['UserID']) && empty($_SESSION['UserID'])) {

			if (!in_array($segmento, $this->autorizadas)) {
				redirect(base_url());
			}

		} else if (in_array($segmento, $this->autorizadas)) {
			redirect("tablero");
		}
	}

}

/* End of file Inicio.php */
/* Location: ./application/hooks/Inicio.php */

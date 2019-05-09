<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Sesion_model');	
	}

	public function index()
	{	
		if (login()) {
			redirect('tablero');

		} else {
			$this->load->view('sesion/cuerpo', array(
				'baccion' => base_url("index.php/sesion/iniciar")
			));
		}
	}

	public function iniciar()
	{
		$dato = array('exito' => false);

		if (elemento($_POST, 'user_name') && 
			elemento($_POST, 'user_password')) {

			$ses = new Sesion_model();
			$usuario = $ses->verificarAcceso($_POST); 

			if ($usuario) 
			{	
				$empresa = $this->vecom->verEmpresas(['empresa' => $usuario->empresa]);

				if ($empresa) {

					$_SESSION['UserID']      = $usuario->usuario;
					$_SESSION['UserName']    = $usuario->nombre;
					$_SESSION['UserMail']    = $usuario->correo;
					$_SESSION['UserAlias']   = $usuario->alias;
					$_SESSION['UserPhoto']   = $usuario->foto;
					$_SESSION['UserJefe']    = $usuario->jefe;
					$_SESSION['UserRol']     = $usuario->rol;
					$_SESSION['UserGenero']  = $usuario->usuario_genero;
					$_SESSION['UserSubjefe'] = $usuario->subjefe;
					$_SESSION['EmpresaID']   = $empresa->empresa;
					$_SESSION['EmpresaName'] = $empresa->nombre;
					$_SESSION['EmpresaAbre'] = $empresa->abreviatura;

					$dato['exito'] = true;
					$dato['redirect'] = base_url("index.php/tablero");

 				} else {
					$dato['mensaje'] = 'Debe tener una empresa asignada para trabajar.';
				}
			} else {
				$dato['mensaje'] = 'El usuario o password ingresado es incorrecto.';
			}
		} else {
			$dato['mensaje'] = 'Por favor ingresa un usuario y la contraseña.';
		}

		enviarJson($dato);
	}

	public function log_out()
	{
		session_destroy();
		redirect('sesion');
	}

}

/* End of file Sesion.php */
/* Location: ./application/controllers/Sesion.php */
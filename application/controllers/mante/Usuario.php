<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mante/Usuario_model');	
		$this->scripts = array((object) array('ruta' => 'public/js/mante.js', 'imp' => true));
	}

	public function index()
	{
		$user = new Usuario_model();

		$this->load->view('principal', [
			'lista'   => $user->get_usuarios(['mante' => true]),
			'vista'   => 'mante/usuario/cuerpo',
			'scripts' => $this->scripts
		]);		
	}

	public function form($usuario='')
	{
		$this->load->library('forms/mante/Fusuario');

		$user = new Usuario_model();
		if (!empty($usuario)) {
			$user->verUsuario($usuario);	
		}

		$form = new Fusuario();
		$form->set_accion(base_url("index.php/mante/usuario/guardar_usuario/{$usuario}"));
		$form->set_registro($user->usuario);
		$form->set_empresas($this->vecom->verEmpresas());
		$form->set_genero($this->vecom->verGenerosUsuarios());
		$form->set_roles($this->vecom->verRoles());

		$this->load->view('mante/usuario/form', [
			'form'    => $form->get_formulario(),
			'usuario' => $user->usuario
		]);
	}

	public function guardar_usuario($usuario='')
	{
		$datos = ['exito' => 2, 'tipo' => 1];

		if (elemento($_POST, 'nombre')   && elemento($_POST, 'correo') &&
    		elemento($_POST, 'telefono') && elemento($_POST, 'alias') &&
    		elemento($_POST, 'empresa')  && elemento($_POST, 'usuario_genero') &&
    		elemento($_POST, 'rol')) {

			$user = new Usuario_model();
			$user->set_datos($_POST);

			if (!empty($usuario)) {
				$user->verUsuario($usuario);
			}

			if ($user->usuario === NULL && empty($user->udato['password'])) {
				$datos['mensaje'] = "Escriba la contraseña de usuario para continuar.";
			} else {

				if ($user->verificaAlias()) {
					$datos['mensaje'] = "El alias ya está siendo utilizado por otro usuario, utilice uno nuevo por favor.";
				} else {
					if ($user->guardarUsuario()) {
						$datos['exito'] = true;
						$datos['ide']   = $user->usuario->usuario;

						if (empty($usuario)) {
							$datos['mensaje'] = "El usuario <b>{$user->usuario->alias}</b> fue creado correctamente";
						} else {
							$datos['mensaje'] = "Los datos del usuario <b>{$user->usuario->alias}</b> se actualizaron.";
						}
					} else {
						$datos['mensaje'] = $user->get_mensaje();
						$datos['exito']   = false;
					}
				}
			}

		} else {
			$datos['mensaje'] = "Por favor complete los campos obligatorios.";
		}

		enviarJson($datos);
	}

	public function lista()
	{
		$user = new Usuario_model();
		$this->load->view('mante/usuario/lista', [
			'lista'   => $user->get_usuarios(['mante' => true])
		]);
	}

	public function anular($usuario)
	{
		$datos = ['exito' => false];

		if ($usuario === $_SESSION['UserID']) {
			$datos['mensaje'] = "No puede realizar esta acción para su usuario";
			$datos['exito']   = 2;
		} else {
			$user = new Usuario_model($usuario);

			$activo = ($user->usuario->activo == 1) ? 0 : 1;
			$texto  = ($user->usuario->activo == 1) ? 'desactivado' : 'activado';
 			
 			$user->set_datos(['activo' => $activo]);
			
			if ($user->guardarUsuario()) {
				$datos['exito'] = true;
				$datos['mensaje'] = "El usuario fue {$texto} correctamente.";
				
			} else {
				$datos['mensaje'] = $user->get_mensaje();
			}
		}

		enviarJson($datos);
	}

}

/* End of file Usuario.php */
/* Location: ./application/controllers/mante/Usuario.php */
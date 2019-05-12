<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vecom extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();

		$this->load->model('mante/Usuario_model');
		$this->user = $_SESSION['UserID'];
	}

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

	public function form_password()
	{
		$user = new Usuario_model($this->user);

		$this->load->view('inicio/password', [
			'xaccion' => base_url('index.php/vecom/cambiar_password'),
			'dato'    => $user->actualizacionPassword()
		]);
	}

	public function cambiar_password()
	{
		$datos = ['exito' => false, 'mensaje' => ''];

		if (elemento($_POST, 'pactual') &&
			elemento($_POST, 'pnueva') &&
			elemento($_POST, 'pconfirmar')) {

			if (trim($_POST['pnueva']) === trim($_POST['pconfirmar'])) {
				
				$user = new Usuario_model($this->user);	

				$user->set_datos(['password' => $_POST['pnueva']]);

				if (sha1(trim($_POST['pactual'])) === $user->usuario->password) {
					
					if (sha1(trim($_POST['pnueva'])) ===  $user->usuario->password) {
						$datos['mensaje'] = "La contraseña nueva no debe ser igual a la que utiliza actualmente.";
					} else {
						if ($user->guardarUsuario()) {

							$datos['exito'] = true;
							$datos['mensaje'] = 'La contraseña fue actualizada correctamente.';
						} else {
							$datos['mensaje'] = 'No fue posible actualizar la información.';
						}
					}
				} else {
					$datos['mensaje'] = 'La contraseña actual es incorrecta, intente de nuevo.';
				}
			} else {
				$datos['mensaje'] = 'Las contraseñas nuevas no son iguales, verifique por favor.';
			}
		} else {
			$datos['mensaje'] = 'Es necesario que complete la información requerida.';
		}

		enviarJson($datos);
	}

	public function pagina($opcion='')
	{
		$notfound = false;

		if (!empty($opcion)) {

			$menu = $this->Menu_model->ver_menu(['menu' => $opcion]);

			if (count($menu) > 0) {
				$_SESSION['vcModulo']  = $menu->modulo;
				$_SESSION['vcSubmenu'] = $menu->submenu;
				$_SESSION['vcMenu']    = $menu->menu;

				redirect(base_url("{$menu->url}"));
			} else {
				$notfound = true;
			}
		} else {
			$notfound = true;
		}
		
		
		if ($notfound == true) {
			unset($_SESSION['vcModulo']);
			unset($_SESSION['vcMenu']);
			unset($_SESSION['vcSubmenu']);

			redirect('tablero');
		}
	}
}

/* End of file Vecom.php */
/* Location: ./application/controllers/Vecom.php */
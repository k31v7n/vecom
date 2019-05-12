<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('mante/Empresa_model');	
		$this->scripts = array((object) array('ruta' => 'public/js/mante.js', 'imp' => true));
	}

	public function index()
	{
		$emp = new Empresa_model();

		$this->load->view('principal', [
			'vista'   => 'mante/empresa/cuerpo',
			'scripts' => $this->scripts,
			'lista'   => $emp->getEmpresas(['mante' => true])
		]);		
	}

	public function form($empresa='')
	{
		$this->load->library('forms/mante/Fempresa');

		$emp = new Empresa_model();
		if (!empty($empresa)) {
			$emp->verEmpresa($empresa);	
		}

		$form = new Fempresa();
		$form->set_accion(base_url("index.php/mante/empresa/guardar_empresa/{$empresa}"));
		$form->set_registro($emp->empresa);
		$form->set_pais_empresa($this->vecom->verPaisesEmpresa());
		$form->set_monedas($this->vecom->verMonedas());
		
		$this->load->view('mante/empresa/form', [
			'form'    => $form->get_formulario(),
			'empresa' => $emp->empresa
		]);
	}

	public function guardar_empresa($empresa='')
	{
		$dato = ['exito' => 2, 'tipo' => 2];

		if (elemento($_POST, 'nombre') &&
		    elemento($_POST, 'pais_empresa') &&
		    elemento($_POST, 'direccion') &&
		    elemento($_POST, 'moneda') &&
		    elemento($_POST, 'nit') &&
		    elemento($_POST, 'abreviatura')) {

			$emp = new Empresa_model();
			$emp->set_datos($_POST);

			if (!empty($empresa)) {
				$emp->verEmpresa($empresa);
			}

			if ($empresa === $_SESSION['EmpresaID'] && !elemento($_POST, 'activo', 0)) {
				$dato['mensaje'] = "No puede desactivar la empresa con la que esta registrada.";
			}  else {

				if ($emp->guardarEmpresa()) {
					$dato['exito'] = true;
					$dato['ide']   = $emp->empresa->empresa;
					if (empty($empresa)) {
						$dato['mensaje'] = "La empresa <b>{$emp->empresa->abreviatura}</b> fue creado correctamente.";
					} else {
						$dato['mensaje'] = "Los datos de la empresa se modificaron correctamente";
					}
				} else {
					$dato['exito'] = false;
					$dato['mensaje'] = $emp->get_mensaje();
				}
			}

		} else {
			$dato['mensaje'] = "Por favor complete los campos obligatorios.";
		}
	  	
	  	enviarJson($dato);
	}

	public function lista()
	{
		$emp = new Empresa_model();

		$this->load->view("mante/empresa/lista", [
			'lista' => $emp->getEmpresas(['mante' => true])
		]);	
	}

	public function pais()
	{
		$emp = new Empresa_model();

		$this->load->view('principal', [
			'vista'   => 'mante/paises/cuerpo',
			'scripts' => $this->scripts,
			'lista'	  => $emp->getPaisesEmpresa(['mante'])
		]);		
	}

	public function form_pais($tipo, $pais='')
	{
		$this->load->library('forms/mante/Fpais');

		$emp = new Empresa_model();
		if (!empty($pais)) {
			$emp->verPaisEmpresa($pais);
		}

		$form = new Fpais();
		$form->set_accion(base_url("index.php/mante/empresa/guardar_pais/{$tipo}/{$pais}"));
		$form->set_registro($emp->pais);

		$this->load->view("mante/paises/form", [
			'form' => $form->get_formulario(),
			'pais' => $emp->pais,
			'tipo' => $tipo
		]);	
	}

	public function guardar_pais($tipo, $pais='')
	{
		$dato = ['exito' => 2, 'forma' => $tipo, 'tipo' => 3];

		if ($tipo == 2) {
			$dato['esmodal'] = true;
		} 

		if (elemento($_POST, 'nombre') &&
	    	elemento($_POST, 'codigo') &&
	    	elemento($_POST, 'codigo_postal') &&
	    	elemento($_POST, 'iva')) {

			$emp = new Empresa_model();
			if (!empty($pais)) {
				$emp->verPaisEmpresa($pais);
			}
			
			if ($emp->guardarPais($_POST)) {
				$dato['mensaje'] = "El país <b>{$emp->pais->nombre}</b> se guardó correctamente.";
				$dato['ide'] = $emp->pais->pais_empresa;
				$dato['exito'] = true;
			} else {
				$dato['mensaje'] = $emp->get_mensaje();
			}
		} else {
			$dato['exito']   = false;
			$dato['mensaje'] = "Por favor complete los campos obligatorios.";
		}

		enviarJson($dato);
	}

	public function lista_pais()
	{
		$emp = new Empresa_model();

		$this->load->view("mante/paises/lista", [
			'lista' => $emp->getPaisesEmpresa(['mante' => true])
		]);	
	}
}

/* End of file Empresa.php */
/* Location: ./application/controllers/mante/Empresa.php */
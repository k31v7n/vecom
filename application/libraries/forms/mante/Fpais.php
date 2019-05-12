<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fpais
{
	protected $ci;
	protected $accion;
	protected $registro = NULL;

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->datos = [];
		$this->label = ['class' => 'col-sm-2 control-label'];
		$this->clase = 'form-control';
	}

	public function set_accion($valor)
	{
		$this->accion = $valor;
	}

	public function set_registro($valor)
	{
		$this->registro = $valor;
	}

	private function open_form()
	{
		$this->datos['fopen'] = form_open(
			$this->accion, 
			array(
				'id'     => 'FormGuardarMante',
				'class'  => 'form-horizontal',
				'method' => 'POST'
			));
	}

	private function boton()
	{
		$ide = 'btnMante';

		$this->datos["boton_{$ide}"] = form_button([
			'id'    => $ide,
			'type'  => 'submit',
			'class' => 'btn btn-sm btn-primary'],
			'<i class="fa fa-save"></i> Guardar'
		);
	}

	private function nombre()
	{
		$ide = 'nombre';
		$nam = 'nombre';

		$this->datos["label_{$nam}"] = form_label(
			'Nombre país:', $ide, ['class' => 'col-sm-3 control-label']);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Nombre',
				'autocomplete' => 'off'
			]);
	}

	private function codigo()
	{
		$ide = 'codigo';
		$nam = 'codigo';

		$this->datos["label_{$nam}"] = form_label(
			'Código país:', $ide, ['class' => 'col-sm-3 control-label']);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Código (Ejemplo: GT)',
 				'autocomplete' => 'off'
			]);
	}

	private function codigo_postal()
	{
		$ide = 'codigo_postal';
		$nam = 'codigo_postal';

		$this->datos["label_{$nam}"] = form_label(
			'Código postal:', $ide, ['class' => 'col-sm-3 control-label']);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Código postal (Ejemplo: 01001)',
				'autocomplete' => 'off'
			]);
	}

	private function iva()
	{
		$ide = 'iva';
		$nam = 'iva';

		$this->datos["label_{$nam}"] = form_label(
			'Valor de IVA:', $ide, ['class' => 'col-sm-3 control-label']);

		$this->datos["input_{$nam}"] = form_input([
				'id'           => $ide, 
				'type'		   => 'number',
				'name'		   => $nam,
				'value'		   => (($this->registro) ? $this->registro->$nam : ''),
				'step'		   => '0.01',
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Valor IVA (Ejemplo: 0.12)',
				'autocomplete' => 'off'
		]);
	}
	
	private function activo()
	{
		$nam = 'activo';

		if ($this->registro) {
			$checked = ($this->registro->$nam) ? TRUE : FALSE;
		} else {
			$checked = TRUE;
		}

		$this->datos["input_{$nam}"] = form_checkbox(
			$nam, 
			1, 
			$checked);
	}

	private function close_form()
	{
		$this->datos['fclose'] = form_close();
	}

	public function get_formulario()
	{
		$this->open_form();
		$this->boton();
		$this->nombre();
		$this->codigo();
		$this->codigo_postal();
		$this->iva();
		$this->activo();
		
		$this->close_form();

		return (object) $this->datos;
	}
}	

/* End of file Fpais.php */
/* Location: ./application/libraries/forms/mante/Fpais.php */

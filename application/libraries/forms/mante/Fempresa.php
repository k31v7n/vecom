<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fempresa
{
	protected $ci;
	protected $paise;
	protected $moneda;
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

	public function set_pais_empresa($valor)
	{
		$this->paise = $valor;
	}

	public function set_monedas($valor)
	{
		$this->moneda = $valor;
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
			'Razón Social:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Nombre Legal',
				'autocomplete' => 'off'
			]);
	}

	private function direccion()
	{
		$ide = 'direccion';
		$nam = 'direccion';

		$this->datos["label_{$nam}"] = form_label(
			'Domicilio Fiscal:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Dirección fisica de la empresa',
				'autocomplete' => 'off'
			]);
	}

	private function representante()
	{
		$ide = 'representante';
		$nam = 'representante';

		$this->datos["label_{$nam}"] = form_label(
			'Representante Legal:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Nombre de la persona encargada',
				'autocomplete' => 'off'
			]);
	}

	private function abreviatura()
	{
		$ide = 'abreviatura';
		$nam = 'abreviatura';

		$this->datos["label_{$nam}"] = form_label(
			'Abreviatura de nombre:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Ejemplo ME (Mi Empresa)',
				'autocomplete' => 'off'
			]);
	}

	private function telefono()
	{
		$ide = 'telefono';
		$nam = 'telefono';

		$this->datos["label_{$nam}"] = form_label(
			'Teléfono:', $ide, ['class' => 'col-sm-1 control-label']);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'type'		   => 'number', 
				'class'        => $this->clase,
				'placeholder'  => 'Número de telefono o celular',
				'autocomplete' => 'off'
			]);
	}

	private function nit()
	{
		$ide = 'nit';
		$nam = 'nit';

		$this->datos["label_{$nam}"] = form_label(
			'NIT:', $ide, ['class' => 'col-sm-1 control-label']);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Número de Identificación Tributaria',
				'autocomplete' => 'off'
			]);
	}

	private function pais_empresa()
	{
		$ide = 'pais_empresa';
		$nam = 'pais_empresa';

		$this->datos["label_{$nam}"] = form_label(
			'País:', $ide, ['class' => 'col-sm-1 control-label']);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->paise, 'pais_empresa','nombre'),
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function moneda()
	{
		$ide = 'moneda';
		$nam = 'moneda';

		$this->datos["label_{$nam}"] = form_label(
			'Moneda:', $ide, ['class' => 'col-sm-1 control-label']);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->moneda, 'moneda','nmoneda'),
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function aplica_iva()
	{
		$nam = 'aplica_iva';

		$this->datos["input_{$nam}"] = form_checkbox(
			$nam, 
			1, 
			($this->registro && $this->registro->$nam) ? TRUE : FALSE);
	}

	private function activo()
	{
		$nam = 'activo';

		$this->datos["input_{$nam}"] = form_checkbox(
			$nam, 
			1, 
			($this->registro && $this->registro->$nam) ? TRUE : FALSE);
	}

	private function close_form()
	{
		$this->datos['fclose'] = form_close();
	}

	public function get_formulario()
	{
		$this->open_form();
		$this->nombre();
		$this->direccion();
		$this->representante();
		$this->abreviatura();
		$this->telefono();
		$this->nit();
		$this->pais_empresa();
		$this->moneda();
		$this->aplica_iva();
		$this->activo();
		$this->boton();
		$this->close_form();

		return (object) $this->datos;
	}

}

/* End of file Fempresa.php */
/* Location: ./application/libraries/forms/mante/Fempresa.php */

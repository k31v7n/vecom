<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fclasificacion
{
	protected $ci;
	private   $registro = null;
	private   $accion   = "";

	public function __construct()
	{
        $this->ci =& get_instance();
        $this->datos = array();
        $this->label = array("class" => "col-sm-2 control-label");
        $this->clase = "form-control";
	}

	public function set_accion($valor='')
	{
		$this->accion=$valor;
	}

	public function set_registro($valor=null)
	{
		$this->registro = $valor;
	}

	private function fopen()
	{
		$this->datos["fopen"] = form_open(
			$this->accion, 
			[
				"id" 	 		=> "formClasificacion",
				"class"  		=> "form-horizontal",
				"method" 		=> "POST",
				"autocomplete" 	=> "off"
			]
		);
	}

	private function nombre()
	{
		$nam = "nombre";
		$ide = "nombre";

		$this->datos["label_{$nam}"] = form_label('Nombre:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			($this->registro)?$this->registro->$nam:'', 
			[
				"id"			=> $ide,
				"class" 		=> $this->clase,
				"type"  		=> "Text",
				"placeholder"	=> "Nombre:"
			]);
	}

	public function boton()
	{
		$ide = 'guardarClas';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      => $ide,
				'type'    => 'submit',
				'class'   => 'btn btn-sm btn-primary'
			],
			'<i class="fa fa-save"></i> Guardar'
		);
	}

	public function boton_cancelar()
	{
		$ide = 'cancelar';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      => $ide,
				'type'    => 'button',
				'class'   => 'btn btn-sm btn-warning',
				'data-dismiss' => 'modal'
			],
			'<i class="fa fa-times-circle"></i> Cancelar'
		);
	}

	private function fclose()
	{
		$this->datos["fclose"] = form_close();
	}

	public function get_formulario()
	{
		$this->fopen();
		$this->nombre();
		$this->boton();
		$this->boton_cancelar();
		$this->fclose();
		return (object)$this->datos;
	}

	

}
?>
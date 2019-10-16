<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fproveedor
{
	protected $ci;
	private   $registro 		= null;
	private   $proveedor_tipo 	= null;
	private   $proveedor_clas 	= null;
	private   $tipo_pago 		= null;
	private   $accion 			= "";

	public function __construct($modal=false)
	{
        $this->ci =& get_instance();
        $this->modal  = $modal;
		$this->datos  = array();
		$this->clase  = "form-control";
		$this->label  = ["class" => "control-label col-sm-2"];
	}

	public function set_proveedor_tipo($valor=null)
	{
		$this->proveedor_tipo=$valor;
	}

	public function set_tipo_pago($valor=null)
	{
		$this->tipo_pago=$valor;
	}

	public function set_clasificaciones($valor=null)
	{
		$this->proveedor_clas=$valor;
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
				"id"	 		=> "formGuardarProv",
				"class"  		=> "form-horizontal",
				"method" 		=> "POST",
				"autocomplete"  => "off"
			]
		);
	}

	private function nit()
	{
		$nam = "nit";
		$ide = "nit";

		$this->datos["label_{$nam}"] = form_label(
			'Nit:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"placeholder"  	=> "Nit",
				"autocomplete" 	=> "off"
			]
		);
	}

	private function nombre()
	{
		$nam = "nombre";
		$ide = "nombre";

		$this->datos["label_{$nam}"] = form_label(
			'Nombre:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"placeholder"  	=> "Nombre",
				"autocomplete" 	=> "off"
			]
		);
	}

	private function razon_social()
	{
		$nam = "razon_social";
		$ide = "razon_social";

		$this->datos["label_{$nam}"] = form_label(
			'Razón social:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"placeholder"  	=> "Razón social",
				"autocomplete" 	=> "off"
			]
		);
	}

	private function direccion()
	{
		$nam = "direccion";
		$ide = "direccion";

		$this->datos["label_{$nam}"] = form_label(
			'Dirección:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"placeholder"  	=> "Dirección",
				"autocomplete" 	=> "off"
			]
		);
	}

	private function telefono()
	{
		$nam = "telefono";
		$ide = "telefono";

		$this->datos["label_{$nam}"] = form_label(
			'Telefono:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"placeholder"  	=> "Telefono",
				"autocomplete" 	=> "off",
				"type"          => "number",
				"step"			=> "1"
			]
		);
	}


	private function contacto()
	{
		$nam = "contacto";
		$ide = "contacto";

		$this->datos["label_{$nam}"] = form_label(
			'Contacto:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"placeholder"  	=> "Contacto",
				"autocomplete" 	=> "off"
			]
		);
	}


	private function credito_contado()
	{
		$nam = "credito_contado";
		$ide = "credito_contado";

		$this->datos["label_{$nam}"] = form_label(
			'Tipo pago:', 
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam,
			comboOpciones($this->tipo_pago, "tipo_pago", "nombre"), 
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"autocomplete" 	=> "off"
			]
		);
	}

	private function dias_credito()
	{
		$nam = "dias_credito";
		$ide = "dias_credito";

		$this->datos["label_{$nam}"] = form_label(
			'Dias de crédito:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"placeholder"  	=> "Dias de crédito",
				"autocomplete" 	=> "off",
				"type"          => "number",
				"step"			=> "1"
			]
		);
	}

	private function proveedor_tipo()
	{
		$nam = "proveedor_tipo";
		$ide = "proveedor_tipo";

		$this->datos["label_{$nam}"] = form_label(
			'Tipo de proveedor:', 
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam,
			comboOpciones($this->proveedor_tipo, "proveedor_tipo", "nombre"), 
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"autocomplete" 	=> "off"
			]
		);
	}

	private function proveedor_clasificacion()
	{
		$nam = "proveedor_clasificacion";
		$ide = "proveedor_clasificacion";

		$this->datos["label_{$nam}"] = form_label(
			'Clasificación:', 
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam,
			comboOpciones($this->proveedor_clas, "proveedor_clasificacion", "nombre"), 
			($this->registro)?$this->registro->$nam:"",
			[
				"id" 			=> $ide,
				"class" 		=> $this->clase,
				"autocomplete" 	=> "off"
			]
		);
	}

	private function boton()
	{
		$ide = 'guardarProv';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      => $ide,
				'type'    => 'submit',
				'class'   => 'btn btn-sm btn-primary'
			],
			'<i class="fa fa-save"></i> Guardar'
		);
	}

	private function boton_cancelar()
	{
		$ide = 'cancelar';

		$tmp = [
			'id'      => $ide,
			'type'    => 'button',
			'class'   => 'btn btn-sm btn-warning',
		];

		if (!$this->modal) {
			$tmp['onclick'] = "closeProvForm()";
		}else{
			$tmp['data-dismiss'] = "modal";

		}

		$this->datos["boton_{$ide}"] = form_button(
			$tmp,
			'<i class="fa fa-times-circle"></i> cancelar'
		);
	}

	private function fclose()
	{
		$this->datos["fclose"] = form_close();
	}

	public function get_formulario()
	{
		$this->fopen();
		$this->nit();
		$this->nombre();
		$this->razon_social();
		$this->direccion();
		$this->telefono();
		$this->contacto();
		$this->credito_contado();
		$this->dias_credito();
		$this->proveedor_tipo();
		$this->proveedor_clasificacion();
		$this->boton();
		$this->boton_cancelar();
		$this->fclose();
		return (object)$this->datos;
	}

}
?>
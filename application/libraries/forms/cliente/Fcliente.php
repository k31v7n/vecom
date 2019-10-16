<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fcliente
{
	protected $ci;
	private $registro=NULL;
	private $cliente_tipos=NULL;
	private $accion="";
	private $datos=array();

	public function __construct()
	{
		$this->label = ["class" => "col-sm-2 control-label"];
		$this->clase = "form-control";
        $this->ci =& get_instance();
	}

	public function set_ciente_tipos($valor='')
	{
		$this->cliente_tipos=$valor;
	}

	public function set_accion($valor='')
	{
		$this->accion=$valor;
	}

	private function fopen()
	{
		$this->datos['fopen'] = form_open($this->accion, [
			'class' 		=> "form-horizontal",
			'autocomplete'  => "off",
			'method'		=> "post",
			'id'			=> "formCliente"
		]);
	}

	private function boton()
	{
		$ide = 'btnGuardar';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      => $ide,
				'type'    => 'submit',
				'class'   => 'btn btn-sm btn-primary'
			],
			'<i class="fa fa-save"></i> Guardar'
		);
	}

	private function nombre()
	{
		$ide = "nombre";
		$nam = "nombre";

		$this->datos["label_{$nam}"] = form_label(
			'Nombre:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:''
			,
			[
				"class" 		=> $this->clase,
				"id"			=> $ide,
				'placeholder'  	=> 'Nombre',
				"autocomplete" 	=> "false"
			]
		);
	}

	private function nit()
	{
		$ide = "nit";
		$nam = "nit";

		$this->datos["label_{$nam}"] = form_label(
			'Nit:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:''
			,
			[
				"class" 		=> $this->clase,
				"id"			=> $ide,
				'placeholder'  	=> 'Nit',
				"autocomplete" 	=> "false"
			]
		);
	}

	private function direccion()
	{
		$ide = "direccion";
		$nam = "direccion";

		$this->datos["label_{$nam}"] = form_label(
			'Dirección:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:''
			,
			[
				"class" 		=> $this->clase,
				"id"			=> $ide,
				'placeholder'   => 'Direccion',
				"autocomplete" 	=> "false"
			]
		);
	}

	private function telefono()
	{
		$ide = "telefono";
		$nam = "telefono";

		$this->datos["label_{$nam}"] = form_label(
			'Teléfono:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:''
			,
			[
				"class" 		=> $this->clase,
				"id"			=> $ide,
				'placeholder'   => 'Teléfono',
				"autocomplete" 	=> "false"
			]
		);
	}

	private function correo()
	{
		$ide = "correo";
		$nam = "correo";

		$this->datos["label_{$nam}"] = form_label(
			'Correo:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:''
			,
			[
				"class" 		=> $this->clase,
				"id"			=> $ide,
				'placeholder'  	=> 'Correo',
				"autocomplete" 	=> "false"
			]
		);
	}

	private function cliente_tipo()
	{
		$ide = 'cliente_tipo';
		$nam = 'cliente_tipo';

		$this->datos["label_{$nam}"] = form_label(
			'Tipo cliente:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->cliente_tipos, 'cliente_tipo','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
			]);
	}

	private function aplica_descuento()
	{
		$ide = 'aplica_descuento';
		$nam = 'aplica_descuento';

		$this->datos["label_{$nam}"] = form_label(
			'Aplica descuento:',
			$ide,
			["class" => "control-label col-sm-3"]
		);

		$this->datos["check_{$nam}"] = form_checkbox(
			[
				"name"  => $nam,
				"id"	=> $ide,
			],
			"1",
			($this->registro&&$this->registro->$nam==1)?TRUE:FALSE
		);
	}

	public function monto_descuento()
	{
		$nam = "monto_descuento";
		$ide = "monto_descuento";

		$this->datos["label_{$nam}"] = form_label(
			'Monto descuento:',
			$ide,
			$this->label
		);

		$opciones = [
			"class" 		=> $this->clase,
			"id"			=> $ide,
			'placeholder'  	=> 'Monto descuento',
			"autocomplete" 	=> "false"
		];
		if (!$this->registro || $this->registro->aplica_descuento=='0')
		{$opciones["readonly"]	= 'readonly';}

		$this->datos["input_{$nam}"] = form_input(
			$nam,
			($this->registro)?$this->registro->$nam:'',
			$opciones
		);
	}

	private function aplica_iva()
	{
		$ide = 'aplica_iva';
		$nam = 'aplica_iva';

		$this->datos["label_{$nam}"] = form_label(
			'Aplica IVA:',
			$ide,
			["class" => "control-label col-sm-3"]
		);

		$this->datos["check_{$nam}"] = form_checkbox(
			[
				"name"  => $nam,
				"id"	=> $ide,
			],
			"1",
			($this->registro&&$this->registro->$nam==1)?TRUE:FALSE
		);
	}

	private function boton_cancelar()
	{
		$ide = 'btnCancelar';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      	   => $ide,
				'class'   	   => 'btn btn-sm btn-warning',
				'data-dismiss' => "modal"
			],
			'<i class="fa fa-times-circle"></i> Cancelar'
		);
	}

	private function fclose()
	{
		$this->datos['fclose'] = form_close();
	}

	public function get_formulario()
	{
		$this->fopen();
		$this->boton();
		$this->nombre();
		$this->nit();
		$this->direccion();
		$this->telefono();
		$this->correo();
		$this->cliente_tipo();
		$this->aplica_descuento();
		$this->monto_descuento();
		$this->aplica_iva();
		$this->boton_cancelar();
		$this->fclose();
		return (object)$this->datos;
	}

}
?>
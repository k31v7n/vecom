<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fcompra
{
	protected $ci;
	private $registro   = null;
	private $accion     = "";
	private $proveedores = null;
	private $tipos_pago = null;
	private $monedas 	= null;
	public function __construct()
	{
        $this->ci =& get_instance();
		$this->datos = array();
		$this->label = array("class" => "control-label col-sm-1");
		$this->label_2 = array("class" => "control-label col-sm-2");
		$this->clase = "form-control";
	}

	public function set_accion($valor='')
	{
		$this->accion = $valor;
	}

	public function set_registro($valor=null)
	{
		$this->registro = $valor;
	}

	public function set_proveedores($valor=null)
	{
		$this->proveedores = $valor;
	}

	public function set_tipos_pago($valor=null)
	{
		$this->tipos_pago = $valor;
	}

	public function set_monedas($valor=null)
	{
		$this->monedas = $valor;
	}

	private function fopen()
	{
		$this->datos["fopen"] = form_open(
			$this->accion, 
			[
				"class"  => "form-horizontal",
				"id" 	 => "FormGuardarCompra",
				"method" => "POST"
			]
		);
	}

	private function fecha_factura()
	{
		$ide = 'fecha_factura';
		$nam = 'fecha_factura';

		$this->datos["label_{$nam}"] = form_label(
			'Fecha:',
			$ide,
			$this->label_2
		);

		$this->datos["input_{$nam}"] = form_input(
			[
				"name" => $nam,
				"type" => "date"
			],
			(($this->registro) ? $this->registro->$nam : date("Y-m-d")),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'autocomplete' => 'off'
			]
		);
	}

	private function fecha_pago()
	{
		$ide = 'fecha_pago';
		$nam = 'fecha_pago';

		$this->datos["label_{$nam}"] = form_label(
			'Fecha de pago:',
			$ide,
			$this->label_2
		);

		$this->datos["input_{$nam}"] = form_input(
			[
				"name" => $nam,
				"type" => "date"
			],
			(($this->registro) ? $this->registro->$nam : date("Y-m-d")),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'autocomplete' => 'off'
			]
		);
	}

	private function serie()
	{
		$ide = 'serie';
		$nam = 'serie';

		$this->datos["label_{$nam}"] = form_label(
			'Serie:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Serie',
				'autocomplete' => 'off'
			]
		);
	}

	private function factura_numero()
	{
		$ide = 'factura_numero';
		$nam = 'factura_numero';

		$this->datos["label_{$nam}"] = form_label(
			'Numero:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Numero de factura',
				'autocomplete' => 'off'
			]
		);
	}

	private function concepto()
	{
		$ide = 'concepto';
		$nam = 'concepto';

		$this->datos["label_{$nam}"] = form_label(
			'Concepto:',
			$ide,
			$this->label_2
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Concepto',
				'autocomplete' => 'off'
			]
		);
	}

	private function proveedor()
	{
		$ide = 'proveedor';
		$nam = 'proveedor';

		$this->datos["label_{$nam}"] = form_label(
			'Proveedor:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->proveedores, 'proveedor','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
			]
		);
	}

	private function tipo_pago()
	{
		$ide = 'tipo_pago';
		$nam = 'tipo_pago';

		$this->datos["label_{$nam}"] = form_label(
			'Tipo de pago:',
			$ide,
			$this->label_2
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->tipos_pago, 'tipo_pago','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
			]
		);
	}

	private function moneda()
	{
		$ide = 'moneda';
		$nam = 'moneda';

		$this->datos["label_{$nam}"] = form_label(
			'Moneda:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->monedas, 'moneda','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
			]
		);
	}

	private function boton()
	{
		$ide = 'btnGuardarCompra';

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
		$ide = 'btnCancelar';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      	   => $ide,
				'class'   	   => 'btn btn-sm btn-warning',
				'onclick'	   => "CloseFCompra()"
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
		$this->fecha_factura();
		$this->serie();
		$this->factura_numero();
		$this->concepto();
		$this->proveedor();
		$this->tipo_pago();
		$this->moneda();
		$this->fecha_pago();
		$this->boton();
		$this->boton_cancelar();
		$this->fclose();
		return (object)$this->datos;
		
	}

	

}
?>
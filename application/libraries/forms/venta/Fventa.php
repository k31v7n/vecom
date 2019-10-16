<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fventa
{
	protected $ci;
	protected $accion;
	protected $clientes 	= NULL;
	protected $registro 	= NULL;
	protected $estatus 		= NULL;
	protected $tipo_pago    = NULL;
	protected $monedas 		= NULL;
	protected $venta_activa = 0;
	public function __construct()
	{
        $this->ci =& get_instance();
        $this->datos = [];
		$this->label = ['class' => 'col-sm-3 control-label'];
		$this->clase = 'form-control';
	}

	public function set_accion($valor)
	{
		$this->accion = $valor;
	}

	public function set_registro($valor)
	{
		$this->registro=$valor;
	}

	public function set_clientes($valor)
	{
		$this->clientes = $valor;
	}

	public function set_estatus($valor)
	{
		$this->estatus = $valor;
	}

	public function set_tipo_pago($valor)
	{
		$this->tipo_pago = $valor;
	}

	public function set_monedas($valor)
	{
		$this->monedas = $valor;
	}

	public function set_venta_activa($valor='')
	{
		$this->venta_activa = $valor;
	}

	private function open_form()
	{
		$this->datos['fopen'] = form_open(
			$this->accion,
			array(
				'id'     => 'FormGuardarVenta',
				'class'  => 'form-horizontal',
				'method' => 'POST'
			),
			[
				"venta_estatus" => $this->venta_activa
			]
		);
	}

	private function boton()
	{
		$ide = 'guardar';

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

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      => $ide,
				'type'    => 'button',
				'class'   => 'btn btn-sm btn-warning',
				'onclick' => "encabezado_venta(".((elemento($this->registro, 'venta'))? $this->registro->venta: 0).")"
			],
			'<i class="fa fa-times-circle"></i> Cancelar'
		);
	}

	private function cliente()
	{
		$ide = 'cliente';
		$nam = 'cliente';

		$this->datos["label_{$nam}"] = form_label(
			'Cliente:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->clientes, 'cliente','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}
	
	private function concepto()
	{
		$ide = 'concepto';
		$nam = 'concepto';

		$this->datos["label_{$nam}"] = form_label(
			'Descripcion:', 
			$ide, 
			$this->label
		);

		$this->datos["input_{$nam}"] = form_textarea(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				"rows"  => "2",
				"class" => $this->clase,
				"id" 	=> $ide,
				"style" => "height: 50px; resize:vertical;"
			]
		);

	}

	private function monto()
	{
		$ide = 'monto';
		$nam = 'monto';

		$this->datos["label_{$nam}"] = form_label(
			'Monto:', 
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Valor',
				'autocomplete' => 'off',
				'type'		   => 'number',
				'readonly'	   => 'readonly'
			]);
	}

	private function venta_estatus()
	{
		$ide = 'venta_estatus';
		$nam = 'venta_estatus';

		$this->datos["label_{$nam}"] = form_label(
			'Estatus:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->estatus, 'venta_estatus','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function tipo_pago($value='')
	{
		$ide = 'tipo_pago';
		$nam = 'tipo_pago';

		$this->datos["label_{$nam}"] = form_label(
			'Tipo Pago:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->tipo_pago, 'tipo_pago','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function moneda($value='')
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
			comboOpciones($this->monedas, 'moneda','nmoneda'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function close_form()
	{
		$this->datos['fclose'] = form_close();
	}

	public function get_formulario()
	{
		$this->open_form();
		$this->boton();
		$this->boton_cancelar();
		$this->cliente();
		$this->concepto();
		$this->monto();
		$this->venta_estatus();
		$this->tipo_pago();
		$this->moneda();
		$this->close_form();
		return (object) $this->datos;
	}
}
?>
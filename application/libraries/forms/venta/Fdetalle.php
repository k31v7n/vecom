<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fdetalle
{
	protected $ci;
	private $registro 	= NULL;
	private $productos 	= NULL;
	private $accion 	= '';
	
	public function __construct()
	{
        $this->ci =& get_instance();
        $this->datos = [];
		$this->label = ['class' => 'col-sm-2 control-label'];
		$this->clase = 'form-control';
	}
	
	public function set_registro($valor='')
	{
		$this->registro=$valor;
	}

	public function set_productos($valor='')
	{
		$this->productos=$valor;
	}

	public function set_accion($valor='')
	{
		$this->accion=$valor;
	}

	private function fopen()
	{
		$this->datos["fopen"] = form_open($this->accion,[
			"id" 	 => "guardarDetalleVenta",
			'class'	 => 'form-horizontal',
			'method' => 'POST'
		]);

	}

	private function boton()
	{
		$ide = 'guardarDetalle';

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
		$ide = 'Cancelar';

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

	private function cantidad()
	{
		$ide = 'cantidad';
		$nam = 'cantidad';

		$this->datos["label_{$nam}"] = form_label(
			'Cantidad:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			[
				"name"  => $nam, 
				"value" => (($this->registro) ? number_format($this->registro->$nam,2) : '1'),
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Cantidad',
				'autocomplete' => 'off',
				'type'		   => 'number',
				'step'		   => '0.01'
			]
		);
	}

	private function precio()
	{
		$ide = 'precio';
		$nam = 'precio';

		$this->datos["label_{$nam}"] = form_label(
			'Precio:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			[
				"name"  => $nam, 
				"value" => (($this->registro) ? $this->registro->$nam : '0.00'),
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Precio',
				'autocomplete' => 'off',
				'type'		   => 'number',
				'step'		   => '0.01'
			]
		);
	}

	private function total()
	{
		$ide = 'total';
		$nam = 'total';

		$this->datos["label_{$nam}"] = form_label(
			'Total:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : '0.00'),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Total',
				'autocomplete' => 'off',
				'type'		   => 'number',
				'step'		   => '0.01',
				'readonly'	   => 'true'
			]
		);
	}

	// private function producto()
	// {
	// 	$ide = 'producto';
	// 	$nam = 'producto';

	// 	$this->datos["label_{$nam}"] = form_label(
	// 		'Producto:',
	// 		$ide,
	// 		$this->label
	// 	);

	// 	$this->datos["select_{$nam}"] = form_dropdown(
	// 		$nam, 
	// 		comboOpciones($this->productos, 'producto','codigo_nombre'),
	// 			(($this->registro) ? $this->registro->$nam : ''),
	// 		[
	// 			'id'       => $ide,
	// 			'class'    => $this->clase,
	// 		]);
	// }


	private function producto()
	{
		$this->datos["input_producto"] = form_input(
			'producto', 
			($this->registro)? $this->registro->producto:'',
			["hidden" => "hidden"]
		);
	}

	private function fclose()
	{
		$this->datos["fclose"] = form_close();
	}

	public function get_formulario()
	{
		$this->fopen();
		$this->boton();
		$this->boton_cancelar();
		$this->cantidad();
		$this->precio();
		$this->total();
		$this->producto();
		$this->fclose();
		return (object)$this->datos;
	}
}
?>
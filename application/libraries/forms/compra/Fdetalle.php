<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fdetalle
{
	protected $ci;
	private $registro   = null;
	private $productos  = null;
	private $accion     = "";
	public function __construct($detalle='')
	{
        $this->ci =& get_instance();
        $this->detalle = $detalle;
		$this->datos = array();
		$this->label = array("class" => "control-label col-sm-2");
		$this->clase = "form-control input-sm";
	}

	public function set_accion($valor='')
	{
		$this->accion = $valor;
	}

	public function set_productos($valor=null)
	{
		$this->productos=$valor;
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
				"class"  => "form-horizontal",
				"id" 	 => "FormGuardarDetalle".$this->detalle,
				"method" => "POST"
			]
		);
	}

	private function producto()
	{
		$ide = 'producto';
		$nam = 'producto';

		$this->datos["label_{$nam}"] = form_label(
			'Producto:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->productos, 'producto','codigo_nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'style'    => "height: 24px; border-radius:0;"
			]
		);
		
	}

	private function cantidad()
	{
		$ide = 'cantidad';
		$nam = 'cantidad';

		$this->datos["label_{$nam}"] = form_label(
			'Cantidad:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : '1'),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Cantidad',
				'type'		   => 'number',
				'step'		   => '1',
				'style'    	   => "height: 24px; border-radius:0;"
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
			$nam, 
			(($this->registro) ? $this->registro->$nam : '0.00'),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Precio',
				'type'		   => 'number',
				'step'		   => '0.01',
				'style'    	   => "height: 24px; border-radius:0;"
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
				'type'		   => 'number',
				'step'		   => '0.01',
				'style'        => "height: 24px; border-radius:0;",
				'readonly' 	   => 'readonly'
			]
		);		
	}

	private function boton()
	{
		$ide = 'guardarDetalle';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      => $ide,
				'type'    => 'submit',
				'class'   => 'btn btn-xs btn-default'
			],
			'<i class="fa fa-check"></i>'
		);
	}

	private function boton_cancelar()
	{
		$ide = 'btnCancelar';

		$this->datos["boton_{$ide}"] = form_button(
			[
				'id'      	   => $ide,
				'class'   	   => 'btn btn-xs btn-warning',
				'type'		   => 'button',
				'onclick'	   => "CancelarDetalle()"
			],
			'<i class="fa fa-times-circle"></i>'
		);
	}

	private function fclose()
	{
		$this->datos["fclose"] = form_close();
	}

	public function get_formulario()
	{
		$this->fopen();
		$this->producto();
		$this->cantidad();
		$this->precio();
		$this->total();
		$this->boton();
		$this->boton_cancelar();
		$this->fclose();
		return (object)$this->datos;
		
	}

	

}
?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fproducto
{
	protected $ci;
	private $registro 		= NULL;
	private $unidad_medida  = NULL;
	private $producto_tipo  = NULL;
	private $proveedor      = NULL;
	private $accion			= NULL;

	public function __construct()
	{
        $this->ci =& get_instance();
		$this->datos = [];
		$this->label = ['class' => 'col-sm-2 control-label'];
		$this->clase = 'form-control';
	}


	public function set_accion($valor='')
	{
		$this->accion = $valor;
	}

	public function set_registro($valor='')
	{
		$this->registro = $valor;
	}

	public function set_unidad_medida($valor='')
	{
		$this->unidad_medida = $valor;
	}

	public function set_produco_tipo($valor='')
	{
		$this->producto_tipo = $valor;
	}

	public function set_proveedor($valor='')
	{
		$this->proveedor = $valor;
	}

	private function fopen()
	{
		$this->datos["fopen"] = form_open($this->accion, [
				'id'     => 'FormGuardarProducto',
				'class'  => 'form-horizontal',
				'method' => 'POST'
		]);
	}

	private function boton()
	{
		$ide = 'guardarProd';

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
				'onclick' => 'closeProdForm()'
			],
			'<i class="fa fa-times-circle"></i> Cancelar'
		);
	}

	private function codigo()
	{
		$ide = 'codigo';
		$nam = 'codigo';

		$this->datos["label_{$nam}"] = form_label(
			'Código:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Código',
				'autocomplete' => 'off'
			]
		);
	}

	private function nombre()
	{
		$ide = 'nombre';
		$nam = 'nombre';

		$this->datos["label_{$nam}"] = form_label(
			'Nombre:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Nombre',
				'autocomplete' => 'off'
			]
		);
	}

	private function proveedor()
	{
		$ide = 'proveedor';
		$nam = 'proveedor';

		$this->datos["label_{$nam}"] = form_label(
			'Provedor:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->proveedor, 'proveedor','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
			]
		);
	}

	private function unidad_medida()
	{
		$ide = 'unidad_medida';
		$nam = 'unidad_medida';

		$this->datos["label_{$nam}"] = form_label(
			'Medida:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->unidad_medida, 'unidad_medida','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase
			]
		);
	}

	private function producto_tipo()
	{
		$ide = 'producto_tipo';
		$nam = 'producto_tipo';

		$this->datos["label_{$nam}"] = form_label(
			'Tipo:',
			$ide,
			$this->label
		);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->producto_tipo, 'producto_tipo','nombre'),
				(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase
			]
		);
	}


	private function precio_compra()
	{
		$ide = 'precio_compra';
		$nam = 'precio_compra';

		$this->datos["label_{$nam}"] = form_label(
			'Precio de compra:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			[
				'name'         => $nam,
				'value' 	   => (($this->registro) ? $this->registro->$nam : '0'),
				'id'           => $ide, 
				'class'        => $this->clase,
				'type' 		   => 'number',
				'step' 		   => '0.01',
				'autocomplete' => 'off'
			]
		);
	}

	private function precio_venta()
	{
		$ide = 'precio_venta';
		$nam = 'precio_venta';

		$this->datos["label_{$nam}"] = form_label(
			'Precio de venta:',
			$ide,
			$this->label
		);

		$this->datos["input_{$nam}"] = form_input(
			[
				'name'  	   => $nam, 
				'value' 	   => (($this->registro) ? $this->registro->$nam : '0'),
				'id'           => $ide, 
				'class'        => $this->clase,
				'placeholder'  => 'Precio de venta',
				'type' 		   => 'number',
				'step' 		   => '0.01',
				'autocomplete' => 'off'
			]
		);
	}

	private function incluye_iva()
	{
		$ide = 'incluye_iva';
		$nam = 'incluye_iva';

		$this->datos["label_{$nam}"] = form_label(
			'Incluye IVA:',
			$ide,
			//["class" => "control-label col-sm-3"]
			$this->label
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

	private function valor_iva()
	{
		$ide = 'valor_iva';
		$nam = 'valor_iva';

		$this->datos["label_{$nam}"] = form_label(
			'Valor:',
			$ide,
			["class" => "col-sm-1 control-label"]
		);

		$this->datos["input_{$nam}"] = form_input(
			[
				'name' 		   => $nam, 
				'value' 	   => (($this->registro) ? $this->registro->$nam : '0'),
				'id'           => $ide, 
				'class'        => $this->clase,
				'type' 		   => 'number',
				'step' 		   => '0.01',
				'autocomplete' => 'off',
				($this->registro&&$this->registro->incluye_iva==1)?"":"readonly" =>"true"
			]
		);
	}

	private function fecha_ingreso()
	{
		$ide = 'fecha_ingreso';
		$nam = 'fecha_ingreso';

		$this->datos["label_{$nam}"] = form_label(
			'Ingreso:',
			$ide,
			$this->label
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

	private function fecha_vencimiento()
	{
		$ide = 'fecha_vencimiento';
		$nam = 'fecha_vencimiento';

		$this->datos["label_{$nam}"] = form_label(
			'Vencimiento:',
			$ide,
			$this->label
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

	private function imagen()
	{
		$ide = 'imagen';
		$nam = 'imagen';

		$this->datos["label_{$nam}"] = form_label(
			'Imagen',
			$ide, 
			$this->label
		);


		$this->datos["input_{$nam}"] = form_input(
			[
				'name' 		   => $nam, 
				'type' 		   => 'file',
				'id'           => $ide, 
				'autocomplete' => 'off',
				'accept' 	   => '.png'
			]
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
		$this->codigo();
		$this->nombre();
		$this->proveedor();
		$this->unidad_medida();
		$this->producto_tipo();
		$this->precio_compra();
		$this->precio_venta();
		$this->incluye_iva();
		$this->valor_iva();
		$this->fecha_ingreso();
		$this->fecha_vencimiento();
		$this->imagen();
		$this->fclose();
		return (object)$this->datos;
	}

}
?>
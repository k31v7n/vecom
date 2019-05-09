<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fusuario
{
	protected $ci;
	protected $rol;
	protected $accion;
	protected $genero;
	protected $empresas;
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

	public function set_empresas($valor)
	{
		$this->empresas = $valor;
	}

	public function set_genero($valor)
	{
		$this->genero = $valor;
	}

	public function set_roles($valor)
	{
		$this->rol = $valor;
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

	private function nombre()
	{
		$ide = 'nombre';
		$nam = 'nombre';

		$this->datos["label_{$nam}"] = form_label(
			'Nombres y apellidos:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input(
			$nam, 
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'           => $ide, 
				'class'        => $this->clase,
				'required'     => 'required',
				'placeholder'  => 'Nombre completo del usuario',
				'autocomplete' => 'off'
			]);
	}

	private function correo()
	{
		$ide = 'correo';
		$nam = 'correo';

		$this->datos["label_{$nam}"] = form_label(
			'Correo electrónico:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input([
			'id'           => $ide, 
			'name'         => $nam,
			'type'		   => 'email',
			'value'		   => (($this->registro) ? $this->registro->$nam : ''),
			'class'        => $this->clase,
			'placeholder'  => 'Cuenta de correo electrónico',
			'autocomplete' => 'off'
		]);
	}

	private function alias()
	{
		$ide = 'alias';
		$nam = 'alias';

		$this->datos["label_{$nam}"] = form_label(
			'Alias o usuario:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input([
			'id'           => $ide, 
			'name'         => $nam,
			'value'		   => (($this->registro) ? $this->registro->$nam : ''),
			'class'        => $this->clase,
			'required'     => 'required',
			'placeholder'  => 'Alias o usuario para acceder al sistema',
			'autocomplete' => 'off'
		]);
	}

	private function telefono()
	{
		$ide = 'telefono';
		$nam = 'telefono';

		$this->datos["label_{$nam}"] = form_label(
			'Teléfono de contacto:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input([
			'id'           => $ide, 
			'name'         => $nam,
			'value'		   => (($this->registro) ? $this->registro->$nam : ''),
			'class'        => $this->clase,
			'placeholder'  => 'Número de teléfono o celular',
			'autocomplete' => 'off'
		]);
	}

	private function password()
	{
		$ide = 'password';
		$nam = 'password';

		$this->datos["label_{$nam}"] = form_label(
			'Contraseña:', $ide, $this->label);

		if (empty($this->registro)) {
			$required    = ['required' => 'required'];
			$placeholder = 'Contraseña para acceder al sistema';
		} else {
			$required    = [];
			$placeholder = 'Ya tiene la contraseña, escriba si desea actualizarlo';
		}

		$this->datos["input_{$nam}"] = form_input(array_merge([
			'id'           => $ide, 
			'name'         => $nam,
			'type'		   => 'password',
			'class'        => "{$this->clase} changepass",
			'placeholder'  => $placeholder,
			'autocomplete' => 'off'
		],$required));
	}

	private function identificacion()
	{
		$ide = 'identificacion';
		$nam = 'identificacion';

		$this->datos["label_{$nam}"] = form_label(
			'No. Identificación:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input([
			'id'           => $ide, 
			'name'         => $nam,
			'value'		   => (($this->registro) ? $this->registro->$nam : ''),
			'class'        => $this->clase,
			'placeholder'  => 'No. identificación personal',
			'autocomplete' => 'off'
		]);
	}

	private function direccion()
	{
		$ide = 'direccion';
		$nam = 'direccion';

		$this->datos["label_{$nam}"] = form_label(
			'Lugar o dirección:', $ide, $this->label);

		$this->datos["input_{$nam}"] = form_input([
			'id'           => $ide, 
			'name'         => $nam,
			'value'		   => (($this->registro) ? $this->registro->$nam : ''),
			'class'        => $this->clase,
			'placeholder'  => 'Lugar o dirección de vivienda',
			'autocomplete' => 'off'
		]);
	}

	private function empresa()
	{
		$ide = 'empresa';
		$nam = 'empresa';

		$this->datos["label_{$nam}"] = form_label(
			'Empresa de trabajo:', $ide, $this->label);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->empresas, 'empresa','cnempresa'),
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function usuario_genero()
	{
		$ide = 'usuario_genero';
		$nam = 'usuario_genero';

		$this->datos["label_{$nam}"] = form_label(
			'Género de usuario:', $ide, $this->label);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->genero, 'usuario_genero','nombre'),
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function rol()
	{
		$ide = 'rol';
		$nam = 'rol';

		$this->datos["label_{$nam}"] = form_label(
			'Cargo (Rol):', $ide, $this->label);

		$this->datos["select_{$nam}"] = form_dropdown(
			$nam, 
			comboOpciones($this->rol, 'rol','nombre'),
			(($this->registro) ? $this->registro->$nam : ''),
			[
				'id'       => $ide,
				'class'    => $this->clase,
				'required' => 'required'
			]);
	}

	private function jefe()
	{
		$nam = 'jefe';

		$this->datos["input_{$nam}"] = form_checkbox(
			$nam, 
			1, 
			($this->registro && $this->registro->$nam) ? TRUE : FALSE);
	}

	private function subjefe()
	{
		$nam = 'subjefe';

		$this->datos["input_{$nam}"] = form_checkbox(
			$nam, 
			1, 
			($this->registro && $this->registro->$nam) ? TRUE : FALSE);
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

	private function close_form()
	{
		$this->datos['fclose'] = form_close();
	}

	public function get_formulario()
	{
		$this->open_form();
		$this->nombre();
		$this->correo();
		$this->alias();
		$this->telefono();
		$this->password();
		$this->identificacion();
		$this->direccion();
		$this->empresa();
		$this->usuario_genero();
		$this->rol();	
		$this->jefe();
		$this->subjefe();
		$this->boton();
		$this->close_form();

		return (object) $this->datos;
	}
}

/* End of file Fusuario.php */
/* Location: ./application/libraries/forms/mante/Fusuario.php */

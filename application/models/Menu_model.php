<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model 
{
	protected $usuario;

	public function __construct()
	{
		
	}

	public function cargarUsuario()
	{
		$this->usuario = $this->vecom->verUsuarios(['usuario' => $_SESSION['UserID']]);
	}

	public function buscar_menu($args=array())
	{	
		if (elemento($args, 'bmenu')) {
			$this->cargarUsuario();	
			if ($this->usuario->root == 0) {
				$this->db
					 ->where('b.usuario', $this->usuario->usuario)
					 ->where('b.activo', 1);
			}

			return $this->db
						->select('a.*')
						->join('usuario_menu b','a.menu = b.menu', 'left')
						->like('a.nombre', $args['bmenu'], 'after')
						->where('a.activo', 1)
						->get('menu a')
						->result();
		}

		return false;
	}

	public function ver_submenu($args=array())
	{
		if (elemento($args, 'submenu')) {
			$this->db->where('submenu', $args['submenu']);
		}

		$tmp = $this->db
					->select('submenu, nombre')
					->where('activo', 1)
					->get('submenu');

		if (elemento($args, 'submenu')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}

	public function ver_modulo($args=array())
	{
		if (elemento($args, 'modulo')) {
			$this->db->where('modulo', $args['modulo']);
		}	

		if (elemento($args, 'modulos')) {
			$this->db->where_in('modulo', $args['modulos']);
		}

		$tmp = $this->db
					->where('activo', 1)
					->order_by('nombre', 'asc')
					->get('modulo');

		if (elemento($args, 'modulo')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}		

	public function ver_menu($args=array())
	{
		if (elemento($args, 'menu')) {
			$this->db->where('menu', $args['menu']);
		}

		$tmp = $this->db
					->where('activo', 1)
					->get('menu');

		if (elemento($args, 'menu')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}

	public function verOpcionesMenu()
	{
		$this->cargarUsuario();

		if ($this->usuario->root == 0) {
			$this->db
				 ->where('d.usuario', $this->usuario->usuario)
				 ->where('d.activo', 1);
		}

		return $this->db
					->select("a.*, 
							b.nombre as nom_modulo, 
							b.icono as ico_modulo, 
							c.nombre as nom_submenu") 
					->from("menu a")
					->join('modulo b', 'b.modulo = a.modulo')
					->join('submenu c', 'c.submenu = a.submenu')
					->join('usuario_menu d', 'd.menu = a.menu', 'left')
					->where('a.activo', 1)
					->where('c.activo', 1)
					->where('b.activo', 1)
					->get()
					->result();
	}

	public function verMenu()
	{
		$datos     = [];
		$registros = $this->verOpcionesMenu();

		if ($registros && count($registros) > 0) {
			foreach ($registros as $key => $row) {
				$datos[$row->modulo]['modulo'] = $row->modulo;
				$datos[$row->modulo]['nombre'] = $row->nom_modulo;
				$datos[$row->modulo]['icono']  = $row->ico_modulo;
				$datos[$row->modulo]['submenu'][$row->submenu]['submenu'] = $row->submenu;
				$datos[$row->modulo]['submenu'][$row->submenu]['nombre']  = $row->nom_submenu;
				$datos[$row->modulo]['submenu'][$row->submenu]['opcion'][$key] = $row;
			}
		}

		return $datos;
	}	
}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */
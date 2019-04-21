<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu_model extends CI_Model 
{
	protected $usuario;

	public function __construct()
	{
		$this->usuario = $this->vecom->verUsuarios(['usuario' => $_SESSION['UserID']]);
	}

	public function buscar_menu($args=array())
	{	
		if (elemento($args, 'bmenu')) {

			if ($this->usuario->root == 0) {
				$this->db->where('a.usuario', $this->usuario->usuario);
			}

			return $this->db
						->select('b.*')
						->join('menu b','a.menu = b.menu')
						->like('b.nombre', $args['bmenu'], 'after')
						->where('a.activo', 1)
						->where('b.activo', 1)
						->get('usuario_menu a')
						->result();
		}

		return false;
	}

	public function ver_accesos()
	{

		$this->db->select('a.*');

		if ($this->usuario->root == 0) {
			$this->db->join('usuario_menu b','b.menu = a.menu')
					 ->where('b.usuario', $this->usuario->usuario)
					 ->where('b.activo', 1);
		}

		return $this->db
			 		->where('a.activo', 1)
			 		->get('menu a')
			 		->result();
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

		$tmp = $this->db
					->where('activo', 1)
					->get('modulo');

		if (elemento($args, 'modulo')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}

	public function ver_menu()
	{
		$opciones = $this->ver_accesos();

		if ($opciones) {
			#$subm = array_unique(arrayResult($opciones, 'submenu'));
			#$submenu = $this->ver_submenu(['nsubmenu' => $subm]);
			$datos = array();
			$menu  = array();

			$modulo = '';

			foreach ($opciones as $key => $row) {

				if ($row->modulo != $modulo) {
					$nmod = $this->ver_modulo(['modulo' => $row->modulo]);
					$menu['modulo']['nombre'] = $nmod->nombre;
					$menu['modulo']['icono'] = $nmod->icono;
				}


				$datos[] = $menu;
				
			}

		}

		return $datos;
	}	
}

/* End of file Menu_model.php */
/* Location: ./application/models/Menu_model.php */
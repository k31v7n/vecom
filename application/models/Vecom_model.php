<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vecom_model extends CI_Model {
	public $mensaje;

	public function set_mensaje($mensaje)
	{
		$this->mensaje = $mensaje;
	}

	public function get_mensaje()
	{
		return $this->mensaje;
	}

	public function verUsuarios($args=array())
	{
		if (elemento($args, 'usuario')) {
			$this->db->where('usuario', $args['usuario']);
		} else {
			$this->db->where('activo', 1);
		}

		$tmp = $this->db->get('usuario');

		if (elemento($args, 'usuario')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}

	public function verEmpresas($args=array())
	{
		if (elemento($args, 'empresa')) {
			$this->db->where('a.empresa', $args['empresa']);
		} 

		if (elemento($args, 'permitidos')) {
			$per = $this->db
						->select('empresa')
						->where('usuario', $_SESSION['UserID'])
						->where('activo', 1)
						->get('usuario_empresa');

			$this->db->where_in('empresa', arrayResult($per->result(), 'empresa'));
		}

		$tmp = $this->db
					->select('a.*, b.nombre as npais, b.codigo, b.iva, concat(a.abreviatura," - ", a.nombre) as cnempresa', false)
					->join('pais_empresa b','b.pais_empresa = a.pais_empresa')
					->where('a.activo', 1)
					->where('b.activo', 1)
					->get('empresa a');

		if (elemento($args, 'empresa')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}

	public function verClientes($args=array())
	{
		if (elemento($args, 'cliente')) {
			$this->db->where('a.cliente', $args['cliente']);
		} else {
			$this->db->where('a.activo', 1);
		}

		if (elemento($args, 'empresa')) {
			$this->db->where('a.empresa', $args['empresa']);
		} else {
			$this->db->where('a.empresa', $_SESSION['EmpresaID']);
		}

		if (elemento($args, 'pais')) {
			$this->db->where('b.pais_empresa', $args['pais']);
		}

		$tmp = $this->db
					->select('a.*, 
							b.nombre as nempresa, 
							c.nombre as npais, 
							c.codigo')
					->join('empresa b','b.empresa = a.empresa')
					->join('pais_empresa c','c.pais_empresa = b.pais_empresa')
					->get('cliente a');

		if (elemento($args, 'cliente')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}

	public function verGenerosUsuarios()
	{
		return $this->db
					->get('usuario_genero')
					->result();
	}

	public function verRoles($args=array())
	{
		if (elemento($args, 'rol')) {
			$this->db->where('rol', $args['rol']);
		}

		$tmp = $this->db->get('rol');

		if (elemento($args, 'uno')) {
			return $tmp->row();
		} else {
			return $tmp->result();
		}

		return false;
	}

	public function verPaisesEmpresa()
	{
		return $this->db
					->where('activo', 1)
					->get('pais_empresa')
					->result();
	}

	public function verMonedas()
	{
		return $this->db
					->select("*, 
							concat(codigo, ' - ', nombre) as nmoneda", false)
					->get('moneda')
					->result();
	}
}

/* End of file Vecom_model.php */
/* Location: ./application/models/Vecom_model.php */
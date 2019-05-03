<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends CI_Model {

	public $usuario = NULL;

	public function __construct($id='')
	{
		if (!empty($id)) {
			$this->verUsuario($id);
		}
	}	

	public function verUsuario($id)
	{
		$this->usuario = $this->db
							  ->where('usuario', $id)
							  ->get('usuario')
							  ->row();
	}

	public function actualizacionPassword()
	{
		$dias = diasPassword();
		return $this->db
					->select("
						datediff(curdate(), date(fecha_cambio)) as dias,
						if(datediff(curdate(), date(fecha_cambio)) > {$dias} ,1,0) as valido,
						fecha_cambio", false)
					->where('usuario', $this->usuario->usuario)
					->order_by("bitacora_password", "desc")
					->limit(1)
					->get("bitacora_password")
					->row();
	}

	public function guardarUsuario(Array $args)
	{
		if (elemento($args, 'password')) {
			$this->db->set('password', sha1($args['password']));
		}

		if ($this->usuario === NULL) {

		} else {
			$this->db
				 ->set('fecha_modificacion', 'now()', false)
				 ->where('usuario', $this->usuario->usuario)
				 ->update('usuario');

			if ($this->db->affected_rows() > 0) {
				$this->verUsuario($this->usuario->usuario);
				return true;
			}
		}

		return false;
	}

	public function guardar_bitacora_password()
	{
		$this->db
			 ->set('fecha_cambio', 'now()', false)
			 ->set('usuario', $this->usuario->usuario)
			 ->insert('bitacora_password');

		if ($this->db->affected_rows() > 0) {
			return true;
		}

		return false;
	}

}

/* End of file Usuario_mode.php */
/* Location: ./application/models/mante/Usuario_mode.php */
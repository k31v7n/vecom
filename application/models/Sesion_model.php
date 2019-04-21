<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sesion_model extends CI_Model {

	public function verificarAcceso(Array $args)
	{
		$tmp = $this->db
					->where('alias', $args['user_name'])
					->where('password', sha1($args['user_password']))
					->where('activo', 1)
					->get('usuario');

		if ($tmp->num_rows() > 0) {
			return $tmp->row();
		}

		return false;
	}

	public function verMenu(Array $args)
	{
		
	}		

}

/* End of file Sesion_model.php */
/* Location: ./application/models/Sesion_model.php */
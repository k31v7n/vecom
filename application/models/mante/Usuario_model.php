<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuario_model extends Vecom_model {

	public $usuario = NULL;
	public $udato   = [];

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

	public function verificaAlias()
	{
		if ($this->usuario !== NULL) {
			$this->db->where('usuario <>', $this->usuario->usuario);
		}

		$tmp = $this->db
					->where('alias', $this->udato['alias'])
					->where('activo', 1)
					->get('usuario');

		if ($tmp->num_rows() > 0) {
			return true;
		}

		return false;
	}

	public function set_datos(Array $args)
	{
		if (elemento($args, 'nombre')) {
			$this->udato['nombre'] = $args['nombre'];
		}

	    if (elemento($args, 'correo')) {
	    	$this->udato['correo'] = $args['correo'];
	    }

	    if (elemento($args, 'telefono')) {
	    	$this->udato['telefono'] = $args['telefono'];
	    }

	    if (elemento($args, 'alias')) {
	    	$this->udato['alias'] = $args['alias'];
	    }

	    if (elemento($args, 'password')) {
	    	$this->udato['password'] = sha1($args['password']);
	    }

	    if (elemento($args, 'identificacion')) {
	    	$this->udato['identificacion'] = $args['identificacion'];
	    }

	    if (elemento($args, 'direccion')) {
	    	$this->udato['direccion'] = $args['direccion'];
	    }

	    if (elemento($args, 'empresa')) {
	    	$this->udato['empresa'] = $args['empresa'];
	    }

	    if (elemento($args, 'usuario_genero')) {
	    	$this->udato['usuario_genero'] = $args['usuario_genero'];
	    }

	    if (elemento($args, 'rol')) {
	    	$this->udato['rol'] = $args['rol'];
	    }

	    if (isset($args['activo'])) {
	    	$this->udato['activo'] = $args['activo'];
	    }

	    $this->udato['jefe']    = elemento($args, 'jefe',0);
		$this->udato['subjefe'] = elemento($args, 'subjefe',0);

	}

	public function guardarUsuario($args=array())
	{
		if ($this->usuario === NULL) {
			$this->db->insert('usuario', $this->udato);
			
			if ($this->db->affected_rows() > 0) {
				$this->verUsuario($this->db->insert_id());
				$this->guardar_bitacora_password();
				return true;

			} else {
				$this->set_mensaje("No fue posible crear el usuario, intentelo de nuevo. (BD)");
			}

		} else {
			$this->db
				 ->set('fecha_modificacion', 'now()', false)
				 ->where('usuario', $this->usuario->usuario)
				 ->update('usuario', $this->udato);

			if ($this->db->affected_rows() > 0) {
				
				if (!empty($this->udato['password']) && 
					$this->udato['password'] !== $this->usuario->password) {
					$this->guardar_bitacora_password();
				}

				$this->verUsuario($this->usuario->usuario);

				return true;

			} else {
				$this->set_mensaje("No fue posible actualizar la información, intentelo de nuevo. (BD)");
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

	public function get_usuarios($args=array())
	{
		if (elemento($args, 'mante')) {
			$this->db->where_in("a.activo", [0,1]);
		} else {
			$this->db->where("a.activo", 1);
		}

		return $this->db
					->select("
						a.*,
						if(jefe = 1, 'Si', 'No') as njefe,
						if (subjefe = 1, 'Si', 'No') as nsubjefe,
						b.nombre as nempresa,
						b.abreviatura as nabreviatura,
						c.nombre as nrol,
						d.nombre as ngenero,
						d.codigo as cgenero", false)
					->from("usuario a")
					->join("empresa b", "b.empresa = a.empresa")
					->join("rol c", "c.rol = a.rol")
					->join("usuario_genero d", "d.usuario_genero = a.usuario_genero")
					->where("b.activo", 1)
					->order_by('activo','desc')
					->order_by('a.nombre','asc')
					->get()
					->result();
	}
}

/* End of file Usuario_mode.php */
/* Location: ./application/models/mante/Usuario_mode.php */
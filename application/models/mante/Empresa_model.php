<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa_model extends Vecom_model {

	public $empresa = NULL;
	public $edato = [];

	public function __construct($id='')
	{
		if (!empty($id)) {
			$this->verEmpresa($id);
		}
	}

	public function verEmpresa($id)
	{
		$this->empresa = $this->db
							  ->where('empresa', $id)
							  ->get('empresa')
							  ->row();
	}

	public function getEmpresas($args=array())
	{
		if (elemento($args, 'mante')) {
			$this->db->where_in("a.activo", [1,0]);
		} else {
			$this->db->where("a.activo", 1);
		}

		return $this->db
					->select("a.*, b.nombre as npais, c.nombre as nmoneda")
					->join("pais_empresa b",'b.pais_empresa = a.pais_empresa')
					->join("moneda c","c.moneda = a.moneda")
					->where("b.activo", 1)
					->order_by("a.nombre", "desc")
					->get("empresa a")
					->result();
	}

	public function set_datos(Array $args)
	{
		if (elemento($args, 'nombre')) {
			$this->edato['nombre'] = $args['nombre'];
		}
	    if (elemento($args, 'pais_empresa')) {
	    	$this->edato['pais_empresa'] = $args['pais_empresa'];
	    }
	    if (elemento($args, 'direccion')) {
	    	$this->edato['direccion'] = $args['direccion'];
	    }
	    if (elemento($args, 'moneda')) {
	    	$this->edato['moneda'] = $args['moneda'];
	    }
	    if (elemento($args, 'representante')) {
	    	$this->edato['representante'] = $args['representante'];
	    }
	    if (elemento($args, 'nit')) {
	    	$this->edato['nit'] = $args['nit'];
	    }
	    if (elemento($args, 'abreviatura')) {
	    	$this->edato['abreviatura'] = $args['abreviatura'];
	    }
	    if (elemento($args, 'telefono')) {
	    	$this->edato['telefono'] = $args['telefono'];
	    }
	    
	    $this->edato['aplica_iva'] = elemento($args, 'aplica_iva',0);
	    $this->edato['activo'] = elemento($args, 'activo', 0);
	}

	public function guardarEmpresa()
	{
		if ($this->empresa === NULL) {
			$this->db->insert('empresa', $this->edato);

			if ($this->db->affected_rows() > 0) {
				$this->verEmpresa($this->db->insert_id());
				return true;
			} else {
				$this->set_mensaje("No fue posible crear la empresa. (DB).");
			}
		} else {
			$this->db
				 ->where('empresa', $this->empresa->empresa)
				 ->update('empresa', $this->edato);

			if ($this->db->affected_rows() > 0) {
				$this->verEmpresa($this->empresa->empresa);
				return true;
			} else {
				$this->set_mensaje("No se realizó ninguna modificación.");
			}
		}

		return false;
	}
}

/* End of file Empresa_model.php */
/* Location: ./application/models/mante/Empresa_model.php */
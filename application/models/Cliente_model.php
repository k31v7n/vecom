<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {

	private $cliente=NULL;
	private $mensaje='';
	public function __construct()
	{
		$this->datoi=array();
		parent::__construct();
	}

	private function set_mensaje($valor='')
	{
		$this->mensaje=$valor;
	}

	public function get_mensaje()
	{
		return $this->mensaje;
	}

	public function set_cliente($cliente='')
	{
		$this->cliente=$this->db->where("cliente", $cliente)
								->get("cliente")
								->row();
	}

	public function get_cliente()
	{
		return $this->cliente;
	}

	public function limpiar_dato_insert()
	{
		$this->datoi=array();
	}

	public function set_dato_insert($indice='', $valor='')
	{
		$this->datoi[$indice]=$valor;
	}

	public function guardar($args=array())
	{
		$this->limpiar_dato_insert();
		
		if (elemento($args, 'nit')){
			$this->set_dato_insert("nit", $args['nit']);
		}

	    if (elemento($args, 'nombre')){
	    	$this->set_dato_insert("nombre", $args['nombre']);
	    }

	    if (elemento($args, 'direccion')){
	    	$this->set_dato_insert("direccion", $args['direccion']);
	    }

	    if (elemento($args, 'telefono')){
	    	$this->set_dato_insert("telefono", $args['telefono']);
	    }

	    if (elemento($args, 'correo')){
	    	$this->set_dato_insert("correo", $args['correo']);
	    }

	    if (elemento($args, 'cliente_tipo')){
	    	$this->set_dato_insert("cliente_tipo", $args['cliente_tipo']);
	    }

	    if (elemento($args, 'aplica_descuento')){
	    	$this->set_dato_insert("aplica_descuento", $args['aplica_descuento']);
	    }

	    if (elemento($args, 'monto_descuento')){
	    	$this->set_dato_insert("monto_descuento", $args['monto_descuento']);
	    }

	    if (elemento($args, 'aplica_iva')){
	    	$this->set_dato_insert("aplica_iva", $args['aplica_iva']);
	    }

	    $this->set_dato_insert("empresa", $_SESSION['EmpresaID']);
	    $this->set_dato_insert("usuario", $_SESSION['UserID']);

	    if ($this->cliente):
	    	$this->db->where("cliente", $this->cliente->cliente);
	    	if ($this->db->update('cliente', $this->datoi)) {
	    		$this->set_mensaje("Se actualizó correctamente el cliente.");
	    		return $this->cliente->cliente;
	    	}else{
	    		$this->set_mensaje("No se pudo actualizar el cliente.");
	    	}
	    else:
	    	if ($this->nit_valido($args['nit'])) {
		    	if ($this->db->insert('cliente', $this->datoi)) {
		    		$this->set_mensaje("Se guardó correctamente el cliente.");
		    		return $this->db->insert_id();
		    	}else{
		    		$this->set_mensaje("Se guardó actualizar el cliente.");
		    	}
	    	}else{
	    		$this->set_mensaje("Ya existe un cliente con el mismo nit.");
	    	}
	    endif;
	    return false;
	}

	public function nit_valido($nit='')
	{
		$nit_l = strtolower($nit);
		$cf = ["cf", "c/f", "c-f"];
		if (in_array($nit_l, $cf) ) {
			return true;
		}else{
			$tmp = $this->db->where("nit", $nit)
							->where("empresa", $_SESSION['EmpresaID'])
							->get("cliente");
			if ($tmp->num_rows() == 0) {
				return true;
			}
		}
		return false;
	}
}
?>